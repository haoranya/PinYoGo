<?php
  namespace App\Http\Libs;

    class Browser{

            static function my_get_browser(){

                if(empty($_SERVER['HTTP_USER_AGENT'])){

                 return 'robot！';

                }

                if( (false == strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident')!==FALSE) ){

                 return 'Internet Explorer 11.0';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 10.0')){

                 return 'Internet Explorer 10.0';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0')){

                 return 'Internet Explorer 9.0';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0')){

                 return 'Internet Explorer 8.0';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0')){

                 return 'Internet Explorer 7.0';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0')){

                 return 'Internet Explorer 6.0';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Edge')){

                 return 'Edge';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){

                 return 'Firefox';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Chrome')){

                 return 'Chrome';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Safari')){

                 return 'Safari';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Opera')){

                 return 'Opera';

                }

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'360SE')){

                 return '360SE';

                }

                 //微信浏览器

                if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessage')){

                 return 'MicroMessage';

                }
                
               }

        }




?>