<?php
  class UpdateVideoProcessor {

     private $conn;
     private $videoId;
     private $videoDataSize;
     private $videoDataError;
     private $videoFileTemp;
     private $sizeLimit = 500000000;
     private $ffmpegPath;
     private $allowedVidType = array("mp4", "mkv", "webm", "flv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");

    public function __construct($conn, $videoDataSize, $videoDataError, $videoFileTemp, $videoId)
    {
      $this->conn = $conn;
      $this->videoId = $videoId;
      $this->videoDataSize = $videoDataSize;
      $this->videoDataError = $videoDataError;
      $this->videoFileTemp = $videoFileTemp;
      $this->ffmpegPath = realpath("../../ffmpeg/bin/ffmpeg.exe");
    }

    public function upload($videoUploadData){
      
      $targetDir = "../../../backend_storage/uploaded_vids/";
      $videoData = $videoUploadData;

      $uniqueId = str_pad(mt_rand(0, 999), 4, '0', STR_PAD_LEFT);
      $tempFilePath = $targetDir . $uniqueId . "_" . $videoData;

      $tempFilePath = str_replace(" ", "_", $tempFilePath);

      $isValidData = $this->processData($tempFilePath);
      
      if(!$isValidData){
        return false;
      }

      if(move_uploaded_file($this->videoFileTemp, $tempFilePath)){
        $finalFilePath = $targetDir . $uniqueId . ".webm";

        if(!$this->insertVideoData($finalFilePath)){
          echo "Insert Query Failed";
          return false;
        }

        if(!$this->convertVideoToWebm($tempFilePath, $finalFilePath)){
          echo "Upload Failed";
          return false;
        }
        
        if (unlink($tempFilePath)) {
          echo '';
        } 

      }

    }

    private function processData ($tempFilePath) {

      // VIDEO TYPE
      $videoType = pathinfo($tempFilePath, PATHINFO_EXTENSION);
      
      if(!$this->isValidSize()){
        echo "FILE TOO LARGE. CANT BE MORE THAN " . $this->sizeLimit;
        return false;
      } else if (!$this->isValidType($videoType)){
        echo "Invalid File type <br>";
        return false;
      } else if($this->hasError()) {
        echo "Error code: " . $this->videoDataError; 
        return false;
      }
      return true;
    }

    private function isValidSize () {
      echo $this->videoDataSize . "<br>";
      return $this->videoDataSize <= $this->sizeLimit;
    }

    private function isValidType ($videoType) {
      $lowecased = strtolower($videoType);
      return in_array($lowecased, $this->allowedVidType);
    }

    private function hasError () {
      return $this->videoDataError != 0;
    }

    private function insertVideoData ($finalFilePath) {

      $unlinkVideo = $this->conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");

      
      $unlinkVideo->bindParam(":video_id", $this->videoId);
      $unlinkVideo ->execute();
      $fetchFilename = $unlinkVideo ->fetch(PDO::FETCH_ASSOC); 

      $vidFilename = $fetchFilename['video_file_name'];
      
      if (unlink($vidFilename)) {
        echo "";
      } 
      

      $queryUpdateData = $this->conn->prepare("UPDATE videos_table SET video_file_name = :video_file_name WHERE id = :video_id");

      $queryUpdateData->bindParam(":video_id", $this->videoId);
      $queryUpdateData->bindParam(":video_file_name", $finalFilePath);

      // STORING VIDEO ID AND VIDEO TITLE INTO SESSIONS

      return $queryUpdateData->execute();
    }

    public function convertVideoToWebm ($tempFilePath, $finalFilePath){
      
      $cmd = "\"$this->ffmpegPath\" -i \"$tempFilePath\" -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis \"$finalFilePath\" 2>&1";

      // $cmd = "ffmpeg -i $tempFilePath $finalFilePath";
      $outputLog = array();
      exec($cmd, $outputLog, $returnCode);

      if($returnCode != 0){
        foreach($outputLog as $line){
          echo $line . "<br>";
        }
        return false;
      }

      return true;
    }

  }
?>