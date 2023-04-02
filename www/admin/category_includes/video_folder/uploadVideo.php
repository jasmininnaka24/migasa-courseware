<?php
  class VideoUploadData {
    
    public $courseID, $courseTitle, $videoTitle, $videoFileName, $videoSubtitle;

    public function __construct($courseID, $courseTitle, $videoTitle, $videoFileName, $videoSubtitle){
      $this->courseID = $courseID;
      $this->courseTitle = $courseTitle;
      $this->videoTitle = $videoTitle;
      $this->videoFileName = $videoFileName;
      $this->videoSubtitle = $videoSubtitle;
    }
  }
?>