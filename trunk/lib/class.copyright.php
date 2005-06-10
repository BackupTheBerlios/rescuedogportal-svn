<?
/**
* 
*   phpsetcopyright - PHP Picture Copright Class
* 	Class for implementing your coprights into different
*	types of pictures at diefferent places inside or outside
*	the picture
*	This Class can work with both GDLib V1.0 and GDLib V2.0
*
* phpsetcopyright - PHP Picture Copright Class
*
* Filename: classes.copyright.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package Classes
* @link http://rescue-dogs.de
* @copyright 2005 BRK Rettungshundestaffel Ansbach
*
* Subversion CVS system settings of current developments
*   $LastChangedDate$
*   $LastChangedRevision$
*   $LastChangedBy$
*   $HeadURL$
*
*/

class phpsetcopyright
{

    /////////////////////////////////////////////////
    // PUBLIC VARIABLES
    /////////////////////////////////////////////////

    /**
     * Sets the Text withch is implemented into your pictures
     * @public
     * @type string
     */
    var $copytext				= "Copyright 2002";


    /**
     * Sets the color Red in RGB Colors, default is 255
     * @public
     * @type int
     */
    var $red					= 255;


    /**
     * Sets the color green in RGB Colors, default is 255
     * @public
     * @type int
     */
    var $green  				= 255;


	/**
     * Sets the color blue in RGB Colors, default is 255
     * @public
     * @type int
     */
    var $blue   				= 255;


    /**
     * Sets the Position in wich teh copytext is placed (1 = upper left corner, 2 = lower left corner,
	 * 3 = lower right corner, 4 = upper right corner ). Default value is 1.
     * @public
     * @type int
     */
    var $copyposition         	= 1;


    /**
     * Sets the Position of copytext inside or outside the picture (1 = Copright placed inside the picture,
	 * 2 = 	the picture will be resized and the copyright is placed outside the picture
	 * [there are still some problems with the colors]). Default value is 1.
     * @public
     * @type int
     */
    var $copyinpicture          = 1;



    /**
     * Sets the Background for the Copytext to ar rectangle(1) or none(0).
	 * Default value is 1.
     * @public
     * @type int
     */
    var $ractanglebg          	= 1;


    /////////////////////////////////////////////////
    // PRIVATE VARIABLES
    /////////////////////////////////////////////////

	/**
     * Holds all color informations in RGB for the rectangle background
     * @type array
     */
    var $copybgcolor			=	array();


	/**
     * Holds all color informations in RGB for the copytext color
     * @type array
     */
    var $copytextcolor			= array();


	/**
     * Holds all pictures in witch the copright should be set
     * @type array
     */
    var $picturearray			= array();


	/**
     * Holds all image informations of the picture
     * @type array
     */
    var $imageinfo          	= array();


	/**
     * Sets the GDLib Version for this classs 2.0(2) or 1.0(1).
	 * Default value is 2.
     * @public
     * @type int
     */
    var $gdlibversion          	= 2;


    /**
     * Creates the IPTC header in jpg files.
	 * Default value is 1.
     * @public
     * @type int
     */
    var $jpg_IPTC			= array();
		
	
    /////////////////////////////////////////////////
    // VARIABLE METHODS
    /////////////////////////////////////////////////


	/**
     * Consctructor Class.
     * @public
     * @returns void
     */
	function phpsetcopyright(){
		if (!function_exists('imagecreatefromjpeg')) {
			die('PHP running on your server does not support the GD image library, check with your webhost if ImageMagick is installed');
		}
		if (function_exists('imagecreatetruecolor')) {
			//die('PHP running on your server does not support GD version 2.x, please switch to GD version 1.x on the config page');
			$this->gdlibversion=2;
		}else{
			$this->gdlibversion=1;
		}
		$this->jpg_IPTC['create']          	= 0;
	}
			
			
	/**
     * Sets the RGB colors for the Background.  Returns void.
     * @public
     * @returns void
     */
    function SetBGcolor($rot, $gruen, $blau) {
    	$this->copybgcolor[red] 	= $rot;
		$this->copybgcolor[green] 	= $gruen;
		$this->copybgcolor[blue] 	= $blau;
    }
	
	
	/**
     * Sets the RGB colors for the Background.  Returns void.
     * @public
     * @returns void
     */
    function SetIPTCData($name, $copyright, $creator) {
		$this->jpg_IPTC['create']          	= 0;
		$this->jpg_IPTC['name']          	= $name;
		$this->jpg_IPTC['copyright']        = $copyright;
		$this->jpg_IPTC['creator']         	= $creator;
    }


	/**
     * Sets the RGB colors for the Textcolor.  Returns void.
     * @public
     * @returns void
     */
    function SetTEXTcolor($rot, $gruen, $blau) {
    	$this->copytextcolor[red] 	= $rot;
		$this->copytextcolor[green] = $gruen;
		$this->copytextcolor[blue] 	= $blau;
    }


    /**
     * Sets Position to upper left corner. Returns void.
     * @public
     * @returns void
     */
    function setpos_upleft() {
        $this->copyposition 	= 1;
    }


    /**
     * Sets Position to lower left corner. Returns void.
     * @public
     * @returns void
     */
    function setpos_lowleft() {
        $this->copyposition 	= 2;
    }


    /**
     * Sets Position to lower right corner. Returns void.
     * @public
     * @returns void
     */
    function setpos_lowright() {
        $this->copyposition 	= 3;
    }


	/**
     * Sets Position to upper right corner. Returns void.
     * @public
     * @returns void
     */
    function setpos_upright() {
        $this->copyposition 	= 4;
    }


	/**
     * Sets Position of the copytext outside the picture. Returns void.
     * @public
     * @returns void
     */
    function setpos_outside() {
        $this->copyinpicture 	= 2;
    }


	/**
     * Sets Position of the copytext inside the picture. Returns void.
     * @public
     * @returns void
     */
    function setpos_inside() {
        $this->copyinpicture 	= 1;
    }


	/**
     * Sets a filled ractangle as Background for the copytext. Returns void.
     * @public
     * @returns void
     */
    function SetRectangleBG() {
        $this->ractanglebg 	= 1;
    }


	/**
     * Sets a no Background for the copytext. Returns void.
     * @public
     * @returns void
     */
    function SetNoBG() {
        $this->ractanglebg 	= 0;
    }


	/**
     * Sets the copytext. Returns void.
     * @public
     * @returns void
     */
    function set_copytext($mycopytext) {
        $this->copytext 		= $mycopytext;
    }


	/**
     * Sets the imageinfo. Returns void.
     * @public
     * @returns void
     */
    function set_imageinfo($datei) {
        $this->imageinfo  = getimagesize($datei);
    }


    /////////////////////////////////////////////////
    // RECIPIENT METHODS
    /////////////////////////////////////////////////

    /**
     * Adds a picture for implementing the copyright.  Returns void.
     * @public
     * @returns void
     */
    function AddPicture($picturepath) {
        $cur = count($this->picturearray);
        $this->picturearray[$cur] = trim($picturepath);
    }


    /////////////////////////////////////////////////
    // COPY RESET METHODS
    /////////////////////////////////////////////////

    /**
     * Clears all pictures assigned in the PICTUREARRAY array.  Returns void.
     * @public
     * @returns void
     */
    function ClearPicture() {
        $this->picturearray = array();
    }


    /////////////////////////////////////////////////
    // SETTING THE BOX METHODS
    /////////////////////////////////////////////////

	/**
     * goes through the picturearray and sets the copyrights into all pictures.  Returns bool.
     * @public
     * @returns bool
     */
	function makecopy(){
		foreach($this->picturearray as $key=>$value){
			$this->make_copyright($value);
			$test=1;
		}
		if($test==0) return false;
		return true;
	}


	/**
     * Selects the GD Lib Version function to make this class be able to word with both GD Lib Versions.  Returns void.
     * @public
     * @returns void
     */
	function make_copyright($datei){
		if($this->gdlibversion==1){
			$this->make_copyright_gd1($datei);
		}elseif($this->gdlibversion==2){
			$this->make_copyright_gd2($datei);
		}else{
			die("The Variable for the GD Lib Copyright Class selection is not set.");
		}
	}
	
	/**
     * For GDLib V2.0
	 * Creates the rectangle sets the colors and the text and saves the new image.  Returns void.
     * @public
     * @returns void
     */
	function make_copyright_gd2($datei){
		$this->set_imageinfo($datei);
		$rectanglelen = strlen($this->copytext)*7.5;

		if($this->imageinfo[2]==1)$img=imagecreatefromgif("$datei");
		if($this->imageinfo[2]==2)$img=imagecreatefromjpeg("$datei");
		if($this->imageinfo[2]==3)$img=imagecreatefrompng("$datei");
		
		$textcolor 	= imagecolorresolve($img, $this->copytextcolor[red], $this->copytextcolor[green], $this->copytextcolor[blue]);
		$bgcolor 	= imagecolorresolve($img, $this->copybgcolor[red], $this->copybgcolor[green], $this->copybgcolor[blue]);

		$korrektur = -25;
		if($this->copyinpicture==2){
			if($this->copyposition==1 or $this->copyposition==4){
				$up = 25;
				$rectx1 = 0;
				$recty1 = 0;
				$rectx2 = $this->imageinfo[0];
				$recty2 = 25;
			}
			if($this->copyposition==2 or $this->copyposition==3){
				$up = 0;
				$rectx1 = 0;
				$recty1 = $this->imageinfo[1];
				$rectx2 = $this->imageinfo[0];
				$recty2 = $this->imageinfo[1] + 25;
			}
			$korrektur = 0;
			
			$imgh = imagecreatetruecolor($this->imageinfo[0], $this->imageinfo[1]+25);
			imagecopyresampled($imgh, $img, 0, $up, 0, 0, $this->imageinfo[0], $this->imageinfo[1]+25, $this->imageinfo[0], $this->imageinfo[1]);

			$img = $imgh;
			$textcolor 		= imagecolorresolve($img, $this->copytextcolor[red], $this->copytextcolor[green], $this->copytextcolor[blue]);
			$bgcolor 		= imagecolorresolve($img, $this->copybgcolor[red], $this->copybgcolor[green], $this->copybgcolor[blue]);
			imagefilledrectangle($img, $rectx1, $recty1, $rectx2 , $recty2, $bgcolor);
		}else{
			// copyright inside the picture
		}
		
		if($this->copyposition==1){
			$recty1		= 0;
			$rectx1		= 0;
			$rectx2		= $rectx1 + $rectanglelen;
			$recty2		= $recty1 + 25;
			$textup		= 5;
			$textleft 	= 7;
		}elseif($this->copyposition==2){
			$recty1		= $this->imageinfo[1] + $korrektur;
			$rectx1		= 0;
			$rectx2		= $rectx1 + $rectanglelen;
			$recty2		= $recty1 + 25;
			$textup		= $recty1 + 5;
			$textleft 	= 7;
		}elseif($this->copyposition==3){
			$rectx1		= $this->imageinfo[0] - $rectanglelen;
			$rectx2		= $this->imageinfo[0];
			$recty1		= $this->imageinfo[1] + $korrektur;
			$recty2		= $recty1 + 25;
			$textup		= $recty1 + 5;
			$textleft 	= $this->imageinfo[0] - $rectanglelen + 7;
		}elseif($this->copyposition==4){;
			$recty1		= 0;
			$rectx1		= $this->imageinfo[0] - $rectanglelen;
			$rectx2		= $rectx1 + $rectanglelen;
			$recty2		= $recty1 + 25;
			$textup		= 5;
			$textleft 	= $this->imageinfo[0] - $rectanglelen + 7;
		}

		if( $this->ractanglebg==1)imagefilledrectangle($img, $rectx1, $recty1, $rectx2, $recty2, $bgcolor);
		imagestring($img, 3, $textleft, $textup, $this->copytext, $textcolor);

		if($this->imageinfo[2]==1)imagegif($img, "$datei");
		if($this->imageinfo[2]==2){
			if($this->$jpg_IPTC['create'] == 1){
				/*
				$this->jpg_IPTC['name']          	= $name;
				$this->jpg_IPTC['copyright']        = $copyright;
				$this->jpg_IPTC['creator']         	= $creator;
				//array iptcembed ( string iptcdata, string jpeg_file_name [, int spool])
				*/
			}
			imagejpeg($img, "$datei");
		}
		if($this->imageinfo[2]==3)imagepng($img, "$datei");
	}
	
	
	/**
     * For GDLib V1.0
	 * Creates the rectangle sets the colors and the text and saves the new image.  Returns void.
     * @public
     * @returns void
     */
	function make_copyright_gd1($datei){
		$this->set_imageinfo($datei);
		$rectanglelen = strlen($this->copytext)*7.5;

		if($this->imageinfo[2]==1)$img=imagecreatefromgif("$datei");
		if($this->imageinfo[2]==2)$img=imagecreatefromjpeg("$datei");
		if($this->imageinfo[2]==3)$img=imagecreatefrompng("$datei");

		$textcolor 	= imagecolorresolve($img, $this->copytextcolor[red], $this->copytextcolor[green], $this->copytextcolor[blue]);
		$bgcolor 	= imagecolorresolve($img, $this->copybgcolor[red], $this->copybgcolor[green], $this->copybgcolor[blue]);

		$korrektur = -25;
		if($this->copyinpicture==2){
			if($this->copyposition==1 or $this->copyposition==4){
				$up = 25;
				$rectx1 = 0;
				$recty1 = 0;
				$rectx2 = $this->imageinfo[0];
				$recty2 = 25;
			}
			if($this->copyposition==2 or $this->copyposition==3){
				$up = 0;
				$rectx1 = 0;
				$recty1 = $this->imageinfo[1];
				$rectx2 = $this->imageinfo[0];
				$recty2 = $this->imageinfo[1] + 25;
			}
			$korrektur = 0;
			$imgh=imagecreate($this->imageinfo[0], ($this->imageinfo[1]+25));
			imagecopy($imgh, $img, 0, $up, 0, 0, $this->imageinfo[0], $this->imageinfo[1]);
			$img = $imgh;
			$textcolor 		= imagecolorresolve($img, $this->copytextcolor[red], $this->copytextcolor[green], $this->copytextcolor[blue]);
			$bgcolor 		= imagecolorresolve($img, $this->copybgcolor[red], $this->copybgcolor[green], $this->copybgcolor[blue]);
			imagefilledrectangle($img, $rectx1, $recty1, $rectx2 , $recty2, $bgcolor);
		}
		if($this->copyposition==1){
			$recty1		= 0;
			$rectx1		= 0;
			$rectx2		= $rectx1 + $rectanglelen;
			$recty2		= $recty1 + 25;
			$textup		= 5;
			$textleft 	= 7;
		}elseif($this->copyposition==2){
			$recty1		= $this->imageinfo[1] + $korrektur;
			$rectx1		= 0;
			$rectx2		= $rectx1 + $rectanglelen;
			$recty2		= $recty1 + 25;
			$textup		= $recty1 + 5;
			$textleft 	= 7;
		}elseif($this->copyposition==3){
			$rectx1		= $this->imageinfo[0] - $rectanglelen;
			$rectx2		= $this->imageinfo[0];
			$recty1		= $this->imageinfo[1] + $korrektur;
			$recty2		= $recty1 + 25;
			$textup		= $recty1 + 5;
			$textleft 	= $this->imageinfo[0] - $rectanglelen + 7;
		}elseif($this->copyposition==4){;
			$recty1		= 0;
			$rectx1		= $this->imageinfo[0] - $rectanglelen;
			$rectx2		= $rectx1 + $rectanglelen;
			$recty2		= $recty1 + 25;
			$textup		= 5;
			$textleft 	= $this->imageinfo[0] - $rectanglelen + 7;
		}

		if( $this->ractanglebg==1)imagefilledrectangle($img, $rectx1, $recty1, $rectx2, $recty2, $bgcolor);
		imagestring($img, 3, $textleft, $textup, $this->copytext, $textcolor);

		if($this->imageinfo[2]==1)imagegif($img, "$datei");
		if($this->imageinfo[2]==2){
			if($this->$jpg_IPTC['create'] == 1){
				/*
				$this->jpg_IPTC['name']          	= $name;
				$this->jpg_IPTC['copyright']        = $copyright;
				$this->jpg_IPTC['creator']         	= $creator;
				//array iptcembed ( string iptcdata, string jpeg_file_name [, int spool])
				*/
			}
			imagejpeg($img, "$datei");
		}
		if($this->imageinfo[2]==3)imagepng($img, "$datei");
	}
}
