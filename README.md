# ApiCacher Bundle
ApiCacher is a symfony2 caching system for data provided by API endpoints.
It is used for optimising the performance of a website that uses external API services for data.

### Installation
Composer:

```sh
"require": {
        "h-space/api-cacher-bundle": "dev-master"
    }
```

```sh
$ composer install
```
### Usage
Include the library:

```sh
    use HSpace\Bundle\ApiCacherBundle\Library\ApiCacher;
```
Initialize class:
```sh
     $cacher = new ApiCacher();
```
Single request:
```sh
     $url = 'https://example.com/api/endpoint?api_key=YOUR_API_KEY'; 
     $fields = null; // if post request, fields is an array with post data else null
     $json_decode = true;
     $rebuild_cache = true; // rebuild cache at the the end of the proccess, more details below
     $response = $cacher->request($url,$fields,$json_decode,$rebuild_cache);

```

Multi Requests:
```sh
     $url_one = 'https://example.com/api/endpoint?api_key=YOUR_API_KEY'; 
     $url_two = 'https://example.com/api/endpoint_two?api_key=YOUR_API_KEY'; 
     $fields = null; // if post request, fields is an array with post data else null
     $json_decode = true;
     $rebuild_cache = true; // rebuild cache at the the end of the proccess, more details below
     $cacher->request_multi($url_one,$fields,$json_decode,$rebuild_cache);
     $cacher->request_multi($url_two,$fields,$json_decode,$rebuild_cache);
     $cacher->execute($json_decode);
     $responses = $cacher->multi_output();
 
 //Accessing the responses
    $url_one_response = $responses[$url_one];
    $url_two_response = $responses[$url_two];
```

Erase Cache Listener
> To erase all cache files include ``` eraseCache=true ``` $_GET parameter in your request.

>Example: http://yoursite.com/homepage?eraseCache=true


# Enable Auto Refreshing Of Cache Files
Import the resource on your ```app/config/routing.yml```
```sh
_hspace:
   resource: "@HSpaceApiCacherBundle/Resources/config/routing.yml"
   ```
Call the function at your end of your class/controller
```sh
        $route = $this->generateUrl('hspace_reload_cache',array(), true); // for controller usage, you have to generate the  url if you are outside of controller
        $cacher->teardown($route);
        
   ```

### Version
1.0.0

License
----

MIT


**Free Software, Hell Yeah!**

