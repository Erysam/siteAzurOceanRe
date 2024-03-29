<?php
class UpLoadFileException extends Exception
{
    public function __construct($code)
    /**
     * Constructeur de la classe UploadException.
     *
     * @param int $code Le code d'erreur présent dans le tab $_FILES['photo']['error'].
     */

    {
        /**
         * Convertit le code d'erreur en message d'erreur.
         *
         * @param int $code Le code d'erreur à convertir.
         * @return string Le message d'erreur correspondant au code d'erreur.
         */

        $message = $this->codeToMessage($code); //Appelle la méthode codeToMessage() >> va retourner le message 

        parent::__construct($message, $code); // appelle le constructeur de la class Exception (classe parent) et passe en param le code et le message de l'erreur comme l'xige le construct
    }



    private function codeToMessage($code) //destinée à être utilisée uniquement à l'intérieur de la classe; pas pertinente en dehors de celle-ci

    {

        switch ($code) {

            case UPLOAD_ERR_INI_SIZE:

                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";

                break;

            case UPLOAD_ERR_FORM_SIZE:

                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";

                break;

            case UPLOAD_ERR_PARTIAL:

                $message = "The uploaded file was only partially uploaded";

                break;

            case UPLOAD_ERR_NO_FILE:

                $message = "No file was uploaded";

                break;

            case UPLOAD_ERR_NO_TMP_DIR:

                $message = "Missing a temporary folder";

                break;

            case UPLOAD_ERR_CANT_WRITE:

                $message = "Failed to write file to disk";

                break;

            case UPLOAD_ERR_EXTENSION:

                $message = "File upload stopped by extension";

                break;



            default:

                $message = "Unknown upload error";

                break;
        }

        return $message;
    }
}
