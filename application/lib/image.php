<?
namespace application\lib;

class Image
{
    private $image;
    private $width;
    private $height;
    private $type;

    function __construct( $file ) 
    {
        $this->setType( $file );
        $this->openImage( $file );
        $this->setSize(  );
    }

    private function setType( $file ) 
    {
        $pic = getimagesize( $file );
        switch( $pic['mime'] ) {
        case 'image/jpeg': $this->type = 'jpg'; break;
        case 'image/png': $this->type = 'png'; break;
        case 'image/gif': $this->type = 'gif'; break;
        }
    }
    private function openImage( $file ) 
    {
        switch( $this->type ) {
        case 'jpg': $this->image = @imagecreatefromJpeg( $file ); break;
        case 'png': $this->image = @imagecreatefromPng( $file ); break;
        case 'gif': $this->image = @imagecreatefromGif( $file ); break;
        }
    }
    private function setSize(  ) 
    {
        $this->width	= imageSX( $this->image );
        $this->height	= imageSY( $this->image );
    }

    public function resize( $width = false, $height = false )
    {
        if ( is_numeric( $width ) && is_numeric( $height ) && $width > 0 && $height > 0 ) {
            $newSize = $this->getSizeByFramework( $width, $height );
            }
            elseif ( is_numeric( $width ) && $width > 0 ) {
            $newSize = $this->getSizeByWidth( $width );
            }
            else {
            $newSize = array( $this->width, $this->height );
            }
            $newImage = imagecreatetruecolor( $newSize[0], $newSize[1] );
            if ( $this->type == 'gif' || $this->type == 'png' ) {
            $white = imagecolorallocate( $newImage, 255, 255, 255 );
            imagefill( $newImage, 0, 0, $white );
        }
        imagecopyresampled( $newImage, $this->image, 0, 0, 0, 0, $newSize[0], $newSize[1], $this->width, $this->height );
        $this->image = $newImage;
        $this->setSize(  );
        return $this;
    }
    private function getSizeByFramework( $width, $height )
    {
        if ( $this->width <= $width && $this->height <= $height ) {
            return array( $this->width, $this->height );
        }
        if ( $this->width / $width > $this->height / $height ) {
            $newSize[0] = $width;
            $newSize[1] = round( $this->height * $width / $this->width );
        }
        else {
            $newSize[0] = round( $this->width * $height / $this->height );
            $newSize[1] = $height;
        }
        return $newSize;
    }
    private function getSizeByWidth( $width )
    {
        if ( $width >= $this->width ) {
        return array( $this->width, $this->height );
        }
        $newSize[0] = $width;
        $newSize[1] = round( $this->height * $width / $this->width );
        return $newSize;
    }
    public function crop( $x0 = 0, $y0 = 0, $w = false, $h = false )
    {
        if ( ! is_numeric( $x0 ) || $x0 < 0 || $x0 >= $this->width ) $x0 = 0;
        if ( ! is_numeric( $y0 ) || $y0 < 0 || $y0 >= $this->height ) $y0 = 0;
        if ( ! is_numeric( $w ) || $w <= 0 || $w > $this->width - $x0 ) $w = $this->width - $x0;
        if ( ! is_numeric( $h ) || $h <= 0 || $h > $this->height - $y0 ) $h = $this->height - $y0;
        return $this->cropSave( $x0, $y0, $w, $h );
    }
    public function watermark(  ) 
    {
        $stamp = imagecreatefromPng( 'watermark.png' );
        $marge_right = 4;
        $marge_bottom = 5;
        $sx = imageSX( $stamp );
        $sy = imageSY( $stamp );
        imagealphablending( $stamp, true );
        imagealphablending( $this->image, true );
        imagecopy( $this->image, $stamp, $this->width - $sx - $marge_right, $this->height - $sy - $marge_bottom, 0, 0, $sx, $sy );
        return $this;
    }
    private function cropSave( $x0, $y0, $w, $h ) {
        $newImage = imagecreatetruecolor( $w, $h );
        imagecopyresampled( $newImage, $this->image, 0, 0, $x0, $y0, $w, $h, $w, $h );
        $this->image = $newImage;
        $this->setSize(  );
        return $this;
    }
    public function watermark(  ) {
        $stamp = imagecreatefromPng( 'watermark.png' );
        $marge_right = 4;
        $marge_bottom = 5;
        $sx = imageSX( $stamp );
        $sy = imageSY( $stamp );
        imagealphablending( $stamp, true );
        imagealphablending( $this->image, true );
        imagecopy( $this->image, $stamp, $this->width - $sx - $marge_right, $this->height - $sy - $marge_bottom, 0, 0, $sx, $sy );
        return $this;
    }
    public function save_base64(  ) {
        ob_start(  );
        imagejpeg( $this->image );
        $outputBuffer = ob_get_clean(  );
        $base64 = 'data:image/'.$this->type.';base64,'.base64_encode( $outputBuffer );
        imagedestroy( $this->image );
        return $base64;
    }
    public function save( $path = '', $fileName, $type = false, $quality = 100 )
    {
    if ( trim( $fileName ) == '' || $this->image === false || ! is_dir( $path ) ) return false;
    $type = strtolower( $type );
    switch( $type )
    {
    case false:
    $savePath = $path.trim( $fileName ).'.'.$this->type;
    switch( $this->type )
        {
        case 'jpg':
        if ( ! is_numeric( $quality ) || $quality < 0 || $quality > 100 ) $quality = 100;
        imagejpeg( $this->image, $savePath, $quality );
        return $savePath;
        case 'png':
        imagepng( $this->image, $savePath );
        return $savePath;
        case 'gif':
        imagegif( $this->image, $savePath );
        return $savePath;
        default:
        return false;
        }
    break;
    case 'jpg':
    $savePath = $path.trim( $fileName ).'.'.$type;
    if ( ! is_numeric( $quality ) || $quality < 0 || $quality > 100 ) $quality = 100;
    imagejpeg( $this->image, $savePath, $quality );
    return $savePath;
    case 'png':
    $savePath = $path.trim( $fileName ).'.'.$type;
    imagepng( $this->image, $savePath );
    return $savePath;
    case 'gif':
    $savePath = $path.trim( $fileName ).".".$type;
    imagegif( $this->image, $savePath );
    return $savePath;
    default:
    return false;
    }
    imagedestroy( $this->image );
    }


}