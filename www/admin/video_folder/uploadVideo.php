<?php
  class VideoUploadData {
    
    public $courseID, $videoTitle, $videoFileName, $videoCaption;

    public function __construct($courseID, $videoTitle, $videoFileName, $videoCaption){
      $this->courseID = $courseID;
      $this->videoTitle = $videoTitle;
      $this->videoFileName = $videoFileName;
      $this->videoCaption = $videoCaption;
    }
  }
?>