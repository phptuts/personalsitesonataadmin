<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Component;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of Cloudinary
 * @DI\Service("app.component.cloudinarymanager")
 * @author student
 */
class CloudinaryManager 
{
    
    private $cloudName;
    
    
    /**
     * @DI\InjectParams({
     *     "cloudName" = @DI\Inject("%cloudinary_name%"),
     *     "apiKey" =  @DI\Inject("%cloudinary_api_key%"),
     *     "apiSecret" = @DI\Inject("%cloudinary_api_secret%")
     * })
     */
    public function __construct($cloudName, $apiKey, $apiSecret) 
    {
        $this->cloudName = $cloudName;
        
        \Cloudinary::config([
            "cloud_name" => $cloudName, 
            "api_key" => $apiKey, 
            "api_secret" => $apiSecret 
          ]);
    }
    
    public function upload(UploadedFile $file, $public_id)
    {
        \Cloudinary\Uploader::destroy($public_id);
        $information = \Cloudinary\Uploader::upload($file->getRealPath(), ['public_id' => $public_id]);
        return json_encode($information);
    }
    
    public function getCloudinaryUrl($information, $edits) 
    {
        return "http://res.cloudinary.com/{$this->cloudName}/image/upload/{$edits}/v{$information['version']}/{$information['public_id']}.{$information['format']}";;
    }
}
