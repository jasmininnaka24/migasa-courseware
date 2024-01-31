<?php
  class VideoProcessor {

     private $conn;
     private $videoDataSize;
     private $videoDataError;
     private $videoFileTemp;
     private $sizeLimit = 500000000;
     private $ffmpegPath;
     private $allowedVidType = array("mp4", "mkv", "webm", "flv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");

    public function __construct($conn, $videoDataSize, $videoDataError, $videoFileTemp)
    {
      $this->conn = $conn;
      $this->videoDataSize = $videoDataSize;
      $this->videoDataError = $videoDataError;
      $this->videoFileTemp = $videoFileTemp;
      $this->ffmpegPath = realpath("../../ffmpeg/bin/ffmpeg.exe");
    }

    public function upload($videoUploadData){
      
      $targetDir = "../../../backend_storage/uploaded_vids/";
      $videoData = $videoUploadData->videoFileName;

      $uniqueId = str_pad(mt_rand(0, 999), 4, '0', STR_PAD_LEFT);
      $tempFilePath = $targetDir . $uniqueId . "_" . $videoData;

      $tempFilePath = str_replace(" ", "_", $tempFilePath);

      $isValidData = $this->processData($tempFilePath);
      
      if(!$isValidData){
        return false;
      }

      if(move_uploaded_file($this->videoFileTemp, $tempFilePath)){
        $finalFilePath = $targetDir . $uniqueId . ".webm";

        if(!$this->insertVideoData($videoUploadData, $finalFilePath)){
          return false;
        }

        if(!$this->convertVideoToWebm($tempFilePath, $finalFilePath)){
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
        // echo "FILE TOO LARGE. CANT BE MORE THAN " . $this->sizeLimit;
        return false;
      } else if (!$this->isValidType($videoType)){
        // echo "INVALID FILE TYPE <br>";
        return false;
      } else if($this->hasError()) {
        // echo "ERROR CODE: " . $this->videoDataError; 
        return false;
      }
      return true;
    }

    private function isValidSize () {
      // echo $this->videoDataSize . "<br>";
      return $this->videoDataSize <= $this->sizeLimit;
    }

    private function isValidType ($videoType) {
      $lowecased = strtolower($videoType);
      return in_array($lowecased, $this->allowedVidType);
    }

    private function hasError () {
      return $this->videoDataError != 0;
    }

    private function insertVideoData ($videoUploadData, $finalFilePath) {

      $queryInsertData = $this->conn->prepare("INSERT INTO videos_table (course_id, video_title, video_file_name) VALUES (:course_id, :video_title, :video_file_name)");

      $queryInsertData->bindParam(":course_id", $videoUploadData->courseID);
      $queryInsertData->bindParam(":video_title", $videoUploadData->videoTitle);
      $queryInsertData->bindParam(":video_file_name", $finalFilePath);
      
      // STORING VIDEO ID AND VIDEO TITLE INTO SESSIONS

      return $queryInsertData->execute();
    }

    public function convertVideoToWebm ($tempFilePath, $finalFilePath){

      $cmd = "\"$this->ffmpegPath\" -i \"$tempFilePath\" -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis \"$finalFilePath\" 2>&1";

      // $cmd = "ffmpeg -i $tempFilePath -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis $finalFilePath";
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