<?
session_start();
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$allowed_ext = array("gif","jpg","jpeg","png");
if(in_array($extension,$allowed_ext))
{
    if($_FILES["file"]["error"] > 0)
    {
        echo "Error".$_FILES["file"]["error"];
    }
    else
    {
        $file_path = "upload/".basename($_FILES["file"]["name"]);
        if (file_exists($file_path))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"],
                $file_path);

            #echo "stored in:".$file_path;
            try{
                $image = new Imagick($file_path);
                $thumb_of_image = $image -> thumbnailimage(100,0);
                $image -> writeimage("upload/".$thumb_of_image);
                $image ->destroy();

                echo ("thumb nail created");
            }catch(Exception $e){
                echo $e -> getMessage();
            }



        }
    }
}
else
{
    echo "Invalid File";
}

?>
