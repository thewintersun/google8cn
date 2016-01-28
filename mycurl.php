<?php 
class mycurl { 
     protected $_useragent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'; 
     protected $_httpHeaders = array();
		
	 protected $_url; 

     protected $_timeout; 
     protected $_maxRedirects; 
     protected $_cookieFileLocation = './cookie.txt'; 
     protected $_post; 
     protected $_postFields; 
     protected $_referer ="http://www.google.com"; 

     protected $_session; 
     protected $_webpage; 
     protected $_includeHeader; 
     protected $_noBody; 
     protected $_status; 

	 
	 // 代理
	 protected $_isUseProxy = false;
	 protected $_proxy = "";
	 protected $_proxyPort = "";
	 
	 
     public    $authentication = 0; 
     public    $auth_name      = ''; 
     public    $auth_pass      = ''; 

	 // 设置是否使用代理
	 public function setIsUseProxy($isUse){
		 $this->_isUseProxy = $isUse; 
	 }
	 
	 // 设置代理
	 public function setProxy($proxy, $proxyPort){
		 $this->_proxy 		= $proxy; 
		 $this->_proxyPort 	= $proxyPort; 
	 }
	 
	 
	 //是否网络要验证用户名密码的
     public function useAuth($use){ 
       $this->authentication = 0; 
       if($use == true) $this->authentication = 1; 
     } 

     public function setName($name){ 
       $this->auth_name = $name; 
     } 
     public function setPass($pass){ 
       $this->auth_pass = $pass; 
     } 
	 
	 // 添加httpheader中的字段
	 public function addHttpHeader($str){
		 array_push($this->_httpHeaders,$str);
	 }
	 
	 // 一次性添加默认的httpheader
	 public function addDefaultHttpHeader(){
		 $this->addHttpHeader("origin: https://www.google.com.hk");
		 $this->addHttpHeader("accept-encoding: gzip, deflate");
		 $this->addHttpHeader("accept-language: zh-CN,zh;q=0.8,en;q=0.6");
		 $this->addHttpHeader("user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36");
		 $this->addHttpHeader("content-type: text/ping");
		 $this->addHttpHeader("accept: */*");
		 $this->addHttpHeader("cache-control: max-age=0");
		 $this->addHttpHeader("authority: www.google.com.hk"); 
	 }
	 
	 // 首次访问谷歌的httpheader
	 public function addFirstVisitHttpHeader(){
		 $this->addHttpHeader("Upgrade-Insecure-Requests: 1");
		 $this->addHttpHeader("accept-encoding: gzip, deflate, sdch");
		 $this->addHttpHeader("accept-language: zh-CN,zh;q=0.8,en;q=0.6");
		 $this->addHttpHeader("user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36");
		 $this->addHttpHeader("content-type: text/ping");
		 $this->addHttpHeader("accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8");
		 $this->addHttpHeader("Cache-Control: max-age=0");
		 $this->addHttpHeader("authority: www.google.com.hk"); 
		 $this->addHttpHeader("x-client-data: CKW2yQEIwbbJAQj9lcoB");
		 $this->addHttpHeader("Proxy-Connection: keep-alive");
	 }

     public function __construct($url,   $includeHeader = false,$noBody = false) 
     { 
         $this->_url = $url; 
         $this->_noBody 		= $noBody; 
         $this->_includeHeader 	= $includeHeader; 


         $this->_cookieFileLocation = dirname(__FILE__).'/cookie.txt'; 

     } 

     public function setReferer($referer){ 
       $this->_referer = $referer; 
     } 

     public function setCookiFileLocation($path) 
     { 
         $this->_cookieFileLocation = $path; 
     } 

     public function setPost ($postFields) 
     { 
        $this->_post = true; 
        $this->_postFields = $postFields; 
     } 

     public function setUserAgent($userAgent) 
     { 
         $this->_useragent = $userAgent; 
     } 

     public function createCurl($url = 'nul') 
     { 
        if($url != 'nul'){ 
          $this->_url = $url; 
        } 

         $s = curl_init(); 

         curl_setopt($s,CURLOPT_URL,$this->_url); 
         curl_setopt($s,CURLOPT_HTTPHEADER,$this->_httpHeaders); 

         curl_setopt($s,CURLOPT_RETURNTRANSFER,true); 

         curl_setopt($s,CURLOPT_COOKIEJAR,$this->_cookieFileLocation); 
         curl_setopt($s,CURLOPT_COOKIEFILE,$this->_cookieFileLocation); 

		// 是否设置了代理
		if($this->_isUseProxy && $this->_proxy != ""){
			curl_setopt($s,CURLOPT_PROXY,$this->_proxy);
			curl_setopt($s,CURLOPT_PROXYPORT,$this->_proxyPort);
		}
		
         if($this->authentication == 1){ 
           curl_setopt($s, CURLOPT_USERPWD, $this->auth_name.':'.$this->auth_pass); 
         } 
         if($this->_post)
         { 
             curl_setopt($s,CURLOPT_POST,true); 
             curl_setopt($s,CURLOPT_POSTFIELDS,$this->_postFields); 
         } 

         if($this->_includeHeader) 
         { 
               curl_setopt($s,CURLOPT_HEADER,true); 
         } 

         if($this->_noBody) 
         { 
             curl_setopt($s,CURLOPT_NOBODY,true); 
         } 

         curl_setopt($s,CURLOPT_USERAGENT,$this->_useragent); 
         curl_setopt($s,CURLOPT_REFERER,$this->_referer); 

         $this->_webpage 	= curl_exec($s); 
         $this->_status 	= curl_getinfo($s,CURLINFO_HTTP_CODE); 
         curl_close($s); 

     } 

   public function getHttpStatus() 
   { 
       return $this->_status; 
   } 

   public function getWebPage(){ 
      return $this->_webpage; 
   } 
} 
?> 