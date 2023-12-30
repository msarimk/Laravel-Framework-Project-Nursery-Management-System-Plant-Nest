<?php

namespace App\Classes;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Helpers\RESTAPIHelper;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\ConsumedMeals;

use function PHPUnit\Framework\isEmpty;

class HelperFunctions
{

  /**
   * Uploade Profile Image
   */
  public static function uploadPlantImage($request, $plants)
  {
    // Get image file
    $image = $request->file('image');
    // Make a image name based on user name and current timestamp
    $name = Str::slug($request->input('name') . time(), "-");
    // Define folder path
    $folder = '/uploads/plants/';
    File::makeDirectory(public_path($folder), 0777, true, true);
    // Make a file path where image will be stored [ folder path + file name + file extension]
    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
    // Upload image
    // dd($filePath);
    Image::make($image)->save(public_path() . $filePath);
    // Remove this for production
    // $image->move(public_path() . $folder, $name . '.' . $image->getClientOriginalExtension());
    // Delete existing image
    if ($plants->image) File::delete(public_path() . $plants->image);

    // Set user profile image path in database to filePath
    $plants->image = $filePath;

    return $plants->save();
  }

  public static function uploadToolImage($request, $tools)
  {
    // Get image file
    $image = $request->file('image');
    // Make a image name based on user name and current timestamp
    $name = Str::slug($request->input('name') . time(), "-");
    // Define folder path
    $folder = '/uploads/tools/';
    File::makeDirectory(public_path($folder), 0777, true, true);
    // Make a file path where image will be stored [ folder path + file name + file extension]
    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
    // Upload image
    // dd($filePath);
    Image::make($image)->save(public_path() . $filePath);
    // Remove this for production
    // $image->move(public_path() . $folder, $name . '.' . $image->getClientOriginalExtension());
    // Delete existing image
    if ($tools->image) File::delete(public_path() . $tools->image);

    // Set user profile image path in database to filePath
    $tools->image = $filePath;

    return $tools->save();
  }

  /**
   * Upload User Profile Banner
   */
  public static function uploadProfileBanner($request, $user)
  {
    // Get file
    $attachments = $request->file('banner');

    // foreach($attachments as $attach){
      $ext = $attachments->getClientOriginalExtension();
      if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){

        // Make a image name based on user name and current timestamp
        $name = Str::slug($request->input('name') . time(), "-");
        // Define folder path
        $folder = '/storage/uploads/banner/';
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name . '.' . $attachments->getClientOriginalExtension();
        // Remove this for production
        if($user->userBanners->isNotEmpty()){
          File::delete(public_path() . $user->userBanners[0]->url);
          $user->userBanners[0]->delete();
        }
        //upload image
        $attachments->move(public_path() . $folder, $name . '.' . $attachments->getClientOriginalExtension());
        // Delete existing image
        $user->userBanners()->create([
          'user_id'   => $user->id,
          'url'       => $filePath
        ]);
    
      }
      elseif($ext == 'mp4' || $ext == 'm4v' || $ext == 'wmv' || $ext == 'mkv' || $ext == 'mov'){

        $name = Str::slug($request->input('name') . time(), "-");
        // Define folder path
        $folder = '/storage/uploads/banner/';
        // Make a file path where video will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name . '.' . $attachments->getClientOriginalExtension();
        // Remove this for production
        if($user->userBanners->isNotEmpty()){
          File::delete(public_path() . $user->userBanners[0]->url);
          $user->userBanners[0]->delete();
        }
        // Upload video
        $attachments->move(public_path() . $folder, $name . '.' . $attachments->getClientOriginalExtension());
        $user->userBanners()->create([
          'user_id'   => $user->id,
          'url'       => $filePath
        ]);
      }
      else{
        return "wrong extension";
      }
    // }

  }
  
  /**
   * Upload Post Image
   */
  public static function uploadPostImage($request, $post)
  {
    // Get image file
    $image = $request->file('file');
    // Make a image name based on user name and current timestamp
    $name = Str::slug($request->input('name') . time(), "-");
    // Define folder path
    $folder = '/storage/uploads/images/post/';
    // Make a file path where image will be stored [ folder path + file name + file extension]
    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
    // Upload image
    // dd($filePath);
    Image::make($image)->fit(130, 130)->save(public_path() . $filePath);
    // Remove this for production
    // $image->move(public_path() . $folder, $name . '.' . $image->getClientOriginalExtension());
    // Delete existing image
    $post->postAttachments()->create([
      'post_id'   => $post->id,
      'url'       => $filePath
    ]);

  }


  /**
   * Upload Post Video
   */
  public static function uploadPostVideo($request, $post)
  {
    // Get video file
    $video = $request->file('file');
    // Make a image name based on user name and current timestamp
    $name = Str::slug($request->input('name') . time(), "-");
    // Define folder path
    $folder = '/storage/uploads/videos/post/';
    // Make a file path where video will be stored [ folder path + file name + file extension]
    $filePath = $folder . $name . '.' . $video->getClientOriginalExtension();
    // Upload video
    $video->move(public_path() . $folder, $name . '.' . $video->getClientOriginalExtension());
    $post->postAttachments()->create([
      'post_id'   => $post->id,
      'url'       => $filePath
    ]);

  }

  /**
   * Upload Slideshow Post
   */
  public static function uploadSlideshowPost($request, $post)
  {
    // Get file
    $attachments = $request->file('file');

    foreach($attachments as $attach){
      $ext = $attach->getClientOriginalExtension();
      if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
      
        $name = Str::slug($attach->getClientOriginalName() . time(), "-");
        // // Define folder path
        $folder = '/storage/uploads/slideshow/';
        // // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name . '.' . $attach->getClientOriginalExtension();
        // // Upload image
        Image::make($attach)->fit(130, 130)->save(public_path() . $filePath);
        // // Remove this for production
        $attach->move(public_path() . $folder, $name . '.' . $attach->getClientOriginalExtension());
        // // Delete existing image
        $post->postAttachments()->create([
          'post_id'   => $post->id,
          'url'       => $filePath
        ]);
      }
      elseif($ext == 'mp4' || $ext == 'm4v' || $ext == 'wmv' || $ext == 'mkv'){

        $name = Str::slug($attach->getClientOriginalName() . time(), "-");
        // Define folder path
        $folder = '/storage/uploads/slideshow/';
        // Make a file path where video will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name . '.' . $attach->getClientOriginalExtension();
        // Upload video
        $attach->move(public_path() . $folder, $name . '.' . $attach->getClientOriginalExtension());
        $post->postAttachments()->create([
          'post_id'   => $post->id,
          'url'       => $filePath
        ]);
      }
      else{
        return "wrong extension";
      }
    }

  }


  /**
   * Upload Post Document
   */
  public static function uploadPostDocument($request, $post)
  {
    // Get document file
    $doc = $request->file('file');
    // Make a image name based on user name and current timestamp
    $name = Str::slug($request->input('name') . time(), "-");
    // Define folder path
    $folder = '/storage/uploads/documents/post/';
    // Make a file path where document will be stored [ folder path + file name + file extension]
    $filePath = $folder . $name . '.' . $doc->getClientOriginalExtension();
    // Upload document
    $doc->move(public_path() . $folder, $name . '.' . $doc->getClientOriginalExtension());
    $post->postAttachments()->create([
      'post_id'   => $post->id,
      'url'       => $filePath
    ]);

  }
  
  /**
   * Number shortner
   * 
   * @return string
   */

  function number_format_short($n, $precision = 1)
  {
    if ($n < 900) {
      // 0 - 900
      $n_format = number_format($n, $precision);
      $suffix = '';
    } else if ($n < 900000) {
      // 0.9k-850k
      $n_format = number_format($n / 1000, $precision);
      $suffix = 'K';
    } else if ($n < 900000000) {
      // 0.9m-850m
      $n_format = number_format($n / 1000000, $precision);
      $suffix = 'M';
    } else if ($n < 900000000000) {
      // 0.9b-850b
      $n_format = number_format($n / 1000000000, $precision);
      $suffix = 'B';
    } else {
      // 0.9t+
      $n_format = number_format($n / 1000000000000, $precision);
      $suffix = 'T';
    }

    // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ($precision > 0) {
      $dotzero = '.' . str_repeat('0', $precision);
      $n_format = str_replace($dotzero, '', $n_format);
    }

    return $n_format . $suffix;
  }

  /**
   * FCM Payload Helper
   */
  public static function fcmPayload($array)
  {
    return [
      "data" => [
        "data_title" => $array['title'],
        "data_body" => $array['description'],
        "data_sound" => "default",
        "data_custom" => [
          'notification_count' => array_key_exists('notification_count', $array) ? $array['notification_count'] : null,
        ],
        "data_badge" => 3
      ],
      "content" => [
        "title" => $array['title'],
        "body" => $array['description'],
        "custom" => [
          'notification_count' => array_key_exists('notification_count', $array) ? $array['notification_count'] : null,
        ],
        "apns-priority" =>  5,
        "content_available" =>  true,
        "sound"  =>  "default"
      ]
    ];
  }

  /**
   * Log User Activity
   */
  public static function logUserActivity($user_id,$post_id=null,$key,$body)
  {
    return \App\Models\User_activity_logs::create([
      'user_id' => $user_id,
      'post_id' => $post_id,
      'event_key' => $key,
      'event_data' => $body,
    ]);
  }

  /**
   * Create Live Stream
   */
  public static function createLiveStream()
  {

        $data = [
          "playback_policy" => "public",
            "new_asset_settings" => [
                "playback_policy" => "public"
            ]
        ];

        $dataString = json_encode($data);
    
        $headers = [
            'Content-Type: application/json',
        ];

        $username = env("MUX_ACCESS_TOKEN");
        $password = env("MUX_TOKEN_SECRET");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.mux.com/video/v1/live-streams');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        return $response;
  }

  /**
   * Disable Live Stream
   */
  public static function disableLiveStream($live_stream_id)
  {

        $data = [
          "playback_policy" => "public",
            "new_asset_settings" => [
                "playback_policy" => "public"
            ]
        ];

        // $dataString = json_encode($data);
    
        $headers = [
            'Content-Type: application/json',
        ];

        $username = env("MUX_ACCESS_TOKEN");
        $password = env("MUX_TOKEN_SECRET");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.mux.com/video/v1/live-streams/'.$live_stream_id.'/disable');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        return $response;
  }

  /**
   * Retrieve Live Stream
   */
  public static function retrieveLiveStream($live_stream_id)
  {

        $data = [
          "playback_policy" => "public",
            "new_asset_settings" => [
                "playback_policy" => "public"
            ]
        ];

        // $dataString = json_encode($data);
    
        $headers = [
            'Content-Type: application/json',
        ];

        $username = env("MUX_ACCESS_TOKEN");
        $password = env("MUX_TOKEN_SECRET");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.mux.com/video/v1/live-streams/'.$live_stream_id);
        // curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        return $response;
  }

  /**
   * Retrieve Asset Detail
   */
  public static function getassets($asset_id)
  {

        $data = [
          "playback_policy" => "public",
            "new_asset_settings" => [
                "playback_policy" => "public"
            ]
        ];
    
        $headers = [
            'Content-Type: application/json',
        ];

        $username = env("MUX_ACCESS_TOKEN");
        $password = env("MUX_TOKEN_SECRET");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.mux.com/video/v1/assets/'.$asset_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        return $response;
  }

  /**
   * Not to show the count of meals consumed
   */
  public static function consumedMeals($user){
      $consumed_meals = ConsumedMeals::whereHas('consumedMeals', function ($query) use($user) {
      })
      ->pluck('meal_id')->toArray();
      return $consumed_meals;
  }

  /**
   * Pagination function
   */
  public static function customPagination($total_records,$per_page,$current_page){
    return array(
      'total' => $total_records,
      'per_page' => $per_page,
      'current_page' => $current_page,
      'last_page' => (int) ceil($total_records / $per_page),
    );
  }
}
