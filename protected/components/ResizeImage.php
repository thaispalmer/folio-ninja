<?php

class ResizeImage
{
    private $originalImage;
    private $originalWidth;
    private $originalHeight;

    private $finalImage;
    private $finalWidth;
    private $finalHeight;

    public $maximumSize = 800;
    public $quality = 80;

    public $originalFile;
    private $type;

    public $maintainAlpha = true;


    private function openImage() {
        if (!file_exists($this->originalFile)) return false;
        list($this->originalWidth,$this->originalHeight,$this->type) = getimagesize($this->originalFile);
        switch ($this->type) {
            case IMAGETYPE_JPEG:
                $this->originalImage = imagecreatefromjpeg($this->originalFile);
                break;

            case IMAGETYPE_PNG:
                $this->originalImage= imagecreatefrompng($this->originalFile);
                break;

            case IMAGETYPE_GIF:
                $this->originalImage = imagecreatefromgif($this->originalFile);
                break;

            default:
                return false;
                break;
        }
        return true;
    }

    private function reduction() {
        if ($this->originalWidth > $this->originalHeight) {
            $this->finalWidth = $this->maximumSize;
            $this->finalHeight = ($this->maximumSize * $this->originalHeight) / $this->originalWidth;
        }
        else {
            $this->finalHeight = $this->maximumSize;
            $this->finalWidth = ($this->maximumSize * $this->originalWidth) / $this->originalHeight;
        }
        $this->finalImage = imagecreatetruecolor($this->finalWidth,$this->finalHeight);
        if ($this->maintainAlpha) {
            imagealphablending($this->finalImage,false);
            imagesavealpha($this->finalImage,true);
            imagecolortransparent($this->finalImage, imagecolorallocatealpha($this->finalImage,0,0,0,127));
        }
        else {
            imagefill($this->finalImage,0,0,imagecolorallocate($this->finalImage,255,255,255));
        }
        imagecopyresampled($this->finalImage,$this->originalImage,0,0,0,0,$this->finalWidth,$this->finalHeight,$this->originalWidth,$this->originalHeight);
    }

    public function resize($maximum = 800) {
        if (!$this->openImage()) return -1;
        $this->maximumSize = $maximum;
        if (($this->originalWidth > $this->maximumSize) || ($this->originalHeight > $this->maximumSize)) {
            $this->reduction();
        }
        else {
            $this->finalImage = $this->originalImage;
        }
        return 1;
    }

    public function save($destination) {
        if (!$this->finalImage) {
            return copy($this->originalFile,$destination);
        }

        if ($this->maintainAlpha) {
            switch ($this->type) {
                case IMAGETYPE_PNG:
                    imagepng($this->finalImage,$destination,9);
                    return true;
                    break;

                case IMAGETYPE_GIF:
                    imagegif($this->finalImage,$destination);
                    return true;
                    break;
            }
        }

        imagejpeg($this->finalImage,$destination,$this->quality);
        return true;
    }

    public function saveThumbnail($destination,$thumbnailWidth,$thumbnailHeight) {
        if (!$this->openImage()) return false;

        if ($this->originalWidth > $this->originalHeight) {
            $finalWidth = $thumbnailWidth;
            $finalHeight = ceil(($thumbnailWidth * $this->originalHeight) / $this->originalWidth);
            if ($finalHeight < $thumbnailHeight) {
                $finalHeight = $thumbnailHeight;
                $finalWidth = ceil(($thumbnailHeight * $this->originalWidth) / $this->originalHeight);
            }
        }
        else {
            $finalHeight = $thumbnailHeight;
            $finalWidth = ceil(($thumbnailHeight * $this->originalWidth) / $this->originalHeight);
            if ($finalWidth < $thumbnailWidth) {
                $finalWidth = $thumbnailWidth;
                $finalHeight = ceil(($thumbnailWidth * $this->originalHeight) / $this->originalWidth);
            }
        }

        $finalImage = imagecreatetruecolor($thumbnailWidth,$thumbnailHeight);
        if ($this->maintainAlpha) {
            imagealphablending($finalImage,false);
            imagesavealpha($finalImage,true);
            imagecolortransparent($finalImage, imagecolorallocatealpha($finalImage,0,0,0,127));
        }
        else {
            imagefill($finalImage,0,0,imagecolorallocate($finalImage,255,255,255));
        }
        imagecopyresampled($finalImage,$this->originalImage,-($finalWidth-$thumbnailWidth)/2,-($finalHeight-$thumbnailHeight)/2,0,0,$finalWidth,$finalHeight,$this->originalWidth,$this->originalHeight);

        if ($this->maintainAlpha) {
            switch ($this->type) {
                case IMAGETYPE_PNG:
                    imagepng($finalImage,$destination,9);
                    return true;
                    break;

                case IMAGETYPE_GIF:
                    imagegif($finalImage,$destination);
                    return true;
                    break;
            }
        }

        imagejpeg($finalImage,$destination,80);
        return true;
    }
}