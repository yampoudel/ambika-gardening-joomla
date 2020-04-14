<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
*
* @package simpleMembership
* @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru);
* Homepage: http://www.ordasoft.com
* Updated on October, 2018
* @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
*/



  // Post action
    $return_url = getReturnURL_SM2($params,$type);
    // Registration URL
    $registration_url = 'index.php?option=com_simplemembership&task=advregister';
    $action =  'index.php?option=com_users&amp;task=user.'.$type;
    ?>
    
      
    <?php
    if ( $type == 'logout' ) { ?>
     <?php
     $return_url = getReturnURL_SM2($params,$type);
     ?>
     <div>
          
              <form action="<?php echo $action ?>" method="post" name="SMS_login" id="login" class="form-inline">
              <?php if ( $params->get('greeting') ) { ?>
              <div><?php echo 'Hi' . ' ' . $name ?></div>
              <?php } ?>
                
              <input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" /><br />

                <ul>
                    <li><a href="index.php?option=com_simplemembership&task=accdetail">Account detail</a></li>
                    <li><a href="index.php?option=com_simplemembership&task=getMail">Extend the group registration</a></li>
                </ul>
                <input type="hidden" name="op2" value="logout" />
                <input type="hidden" name="return" value="<?php echo $return_url ?>" />
                <input type="hidden" name="lang" value="english" />
                <?php echo JHtml::_('form.token');  ?>
                <input type="hidden" name="message" value="0" />
              </form>
      </div>
        
    <?php }else { ?> 
    <div style="position: relative;">
          <div id="default_error_message"></div>
        <?php if($params->get('show_joomla_login')){ ?>
        <form action="<?php echo $action ?>" method="post" name="SMS_login" id="login">
          <?php if ( $params->get('pretext') ) { ?>
          <?php echo $params->get('pretext'); ?>
          <br />
          <?php } ?>
          <div class="input-prepend">
                  <span class="add-on">
                    <span class="icon-user hasTooltip" title="<?php echo JText::_('JGLOBAL_USERNAME') ?>"></span>
                     <label for="mod-username" class="element-invisible"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
                  </span>
                  <input id="mod-username" type="text" name="username" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>"/>
          </div>
          <br>
          <div class="input-prepend">
                  <span class="add-on">
                    <span class="icon-lock hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"></span>
                    <label for="mod-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
                  </span>
                  <input id="mod-passwd" type="password" name="password" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"/>
          </div>
          <br />

          <button type="submit" tabindex="0" name="SMS_Submit" class="btn btn-primary" onclick="javascript:sms_login_submitbutton('SMS_Submit'); return false;"><?php echo JText::_('JLOGIN') ?></button>

          <ul class="ul_wraper">
            <li>
              <label for="remember_vmlogin"><?php echo JText::_('MOD_SMS_LOGIN_REMEMBER_ME') ?></label>
              <input type="checkbox" name="remember" id="remember_vmlogin" value="yes" checked="checked" />
            </li>
            <li><a href="<?php echo $reset_url ?>"><?php echo JText::_('MOD_SMS_LOGIN_LOST_PASSWORD') ?></a></li>
            <?php if ( $remind_url ) { ?>
            <li><a href="<?php echo $remind_url ?>"><?php echo JText::_('MOD_SMS_LOGIN_FORGOT_LOGIN') ?></a></li>
            <?php } ?>
            <?php if ($user_configuration['allow_registration'] == '1') { ?>
            <li><a href="<?php echo $registration_url ?>"><?php echo JText::_('MOD_SMS_LOGIN_CREATE_ACCOUNT') ?></a></li>
            <?php } ?>
          </ul>
          <input type="hidden" value="login" name="op2" />
          <input type="hidden" value="<?php echo $return_url ?>" name="return" />
          <?php
          if (version_compare(JVERSION, '3.0.0', 'ge')) {
          echo JHtml::_('form.token'); } else { ?>
          <input type="hidden" name="<?php echo $validate; ?>" value="1" />
          <?php } ?>
          <?php echo $params->get('posttext'); ?>
         </form>
        <?php } ?>
         
         
         <div class="social_login"> 
             <?php if($params->get('show_gmail_login')){ ?>
             
             <button id="sign-in-or-out-button" onclick="javascript:handleAuthClick();"><img width="20px" src="<?php echo JURI::root(); ?>components/com_simplemembership/images/gmail_logo.png"> <?php echo $params->get('gmail_btn_text'); ?></button>
             <?php } ?>
         </div>
          <div class="login_captcha" id="login_captcha" style="max-width:100%"><?php showLoginCaptcha($params); ?></div>
          <div class="preloader_wrapper" style="display: none;"><img src="<?php echo JURI::root(); ?>components/com_simplemembership/images/lazy_loading.gif" alt=""></div>
      </div>
         
    <?php } ?>
    

    <?php if($params->get('show_gmail_login')){ ?>
    <script async defer src="https://apis.google.com/js/api.js" 
        onload="this.onload=function(){};handleClientLoad()" 
        onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <?php } ?>
<script type="text/javascript">
function sms_login_submitbutton(pressbutton) {
    if(document.querySelector('[name="keyguest"]')){
        document.querySelector('[name="keyguest"]').style.borderColor = '';
    }
    if(document.getElementById('mod-username')){
        document.getElementById('mod-username').style.borderColor = '';
        document.getElementById('mod-passwd').style.borderColor = '';
    }
    var error_div = document.getElementById('default_error_message');
    if(!check_captcha()){
        return;
    }
    var xhr = new XMLHttpRequest();
    var login = document.getElementById('mod-username').value;
    var pass = document.getElementById('mod-passwd').value;
    xhr.open("POST", "index.php?option=com_simplemembership&task=checkLoginPass&login="+login+"&pass="+pass+"&format=raw", false);
    xhr.send();
    
    if (xhr.status != 200) {
      // обработать ошибку
      alert( xhr.status + ': ' + xhr.statusText ); 
    } else {
        
        if(xhr.responseText == '"success"'){
            
            var form = document.SMS_login;
            form.submit();
            return false;
        }else{
            document.getElementById('mod-username').style.borderColor = 'red';
            document.getElementById('mod-passwd').style.borderColor = 'red';
            var append_p = document.createElement('p');
            append_p.innerHTML = "Username or Password is incorrect!";
            error_div.appendChild(append_p);
            setTimeout(function() {
                append_p.parentNode.removeChild(append_p);
            }, 3000);
        }
      
    }

}

function check_captcha(){
    var error_div = document.getElementById('default_error_message');
    var show_captcha = '<?php echo $params->get('show_captcha'); ?>';
    var recaptcha = '<?php echo $app->get('captcha'); ?>';
    var my_id = <?php echo $my->id; ?>;
    if(show_captcha == 1 && recaptcha == 'recaptcha' && my_id == 0 && window.grecaptcha !== undefined){
        var response = grecaptcha.getResponse();
        if(response.length == 0){
            //alert('Captcha is not verified!');
            var append_p = document.createElement('p');
            append_p.innerHTML = "Captcha is not verified!";
            error_div.appendChild(append_p);
            setTimeout(function() {
                append_p.parentNode.removeChild(append_p);
            }, 3000);
            return false;
        }
    }else if(show_captcha == 1 && my_id == 0){
        var keystring = '<?php echo $session->get('captcha_keystring', 'default'); ?>';
        var keyguest = document.querySelector('[name="keyguest"]').value;

        if(keystring != keyguest){
            //alert('Captcha is not verified!');
            document.querySelector('[name="keyguest"]').style.borderColor = 'red';
            var append_p = document.createElement('p');
            append_p.innerHTML = "Captcha is not verified!";
            error_div.appendChild(append_p);
            setTimeout(function() {
                append_p.parentNode.removeChild(append_p);
            }, 3000);
            return false;
        }
    }
    return true;
}

function ready() {
    var reCaptchaWidth = 302;
    if(document.getElementById('login_captcha') != null){
        var containerWidth = document.getElementById('login_captcha').offsetWidth;
    }else{
        var containerWidth = 0
    }
    if(containerWidth > 0){
        var captca_elem = document.getElementsByClassName('g-recaptcha')[0];

        if(reCaptchaWidth > containerWidth && captca_elem != undefined && captca_elem.getAttribute('data-size') == 'normal') {
            var reCaptchaScale = containerWidth / reCaptchaWidth;

            captca_elem.style.cssText="transform: scale("+reCaptchaScale+"); \
            transform-origin: left top; \
            ";
        }
    }
    
    
}

document.addEventListener("DOMContentLoaded", ready);
window.onresize = function() {
    ready()
}
  
  //GOOGLE Autorisation
  var GoogleAuth;
  //var SCOPE = 'https://www.googleapis.com/auth/drive.metadata.readonly';
  var SCOPE = 'https://www.googleapis.com/auth/userinfo.profile';
  function handleClientLoad() {
    // Load the API's client and auth2 modules.
    // Call the initClient function after the modules load.
    
    gapi.load('client:auth2', initClient);
  }

  function initClient() {
    // Retrieve the discovery document for version 3 of Google Drive API.
    // In practice, your app can retrieve one or more discovery documents.
    var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

    // Initialize the gapi.client object, which app uses to make API requests.
    // Get API key and client ID from API Console.
    // 'scope' field specifies space-delimited list of access scopes.
    var apiKey = '<?php echo $params->get('gmail_api_key'); ?>';
    var clientId = '<?php echo $params->get('gmail_client_id'); ?>';
    
    if(apiKey && clientId){
        gapi.client.init({
            'apiKey': apiKey,
            'discoveryDocs': [discoveryUrl],
            'clientId': clientId,
            'scope': SCOPE
        }).then(function () {

          GoogleAuth = gapi.auth2.getAuthInstance();

          // Listen for sign-in state changes.
          GoogleAuth.isSignedIn.listen(updateSigninStatus);

          // Call handleAuthClick function when user clicks on
          //      "Sign In/Authorize" button.
//          jQuerOs('#sign-in-or-out-button').click(function() {
//            handleAuthClick();
//          }); 

        });
    }
  }

  function handleAuthClick() {
    var apiKey = '<?php echo $params->get('gmail_api_key'); ?>';
    var clientId = '<?php echo $params->get('gmail_client_id'); ?>';
    if(apiKey && clientId){
        if (GoogleAuth.isSignedIn.get()) {
          // User is authorized and has clicked 'Sign out' button.
          GoogleAuth.signOut();
        } else {
          // User is not signed in. Start Google auth flow.
          GoogleAuth.signIn();
        }
    }else{
        alert('Please enter the Gmail API key and(or) Gmail client ID in the module settings!');
    }
  }

  function updateSigninStatus(isSignedIn) {
    
    var user = GoogleAuth.currentUser.get();
    var isAuthorized = user.hasGrantedScopes(SCOPE);
    if (isAuthorized) {
        if(!check_captcha()){
          return;
        }
        var userInfo = user.w3;
        socialLogin('google', userInfo);
    }
  }
  
  
  //login in Joomla using social networks
  function socialLogin(socialName, userInfo){
    jQuerOs('.preloader_wrapper').show();
    
    jQuerOs.ajax({
        dataType: "json",
        type: 'POST',
        url: 'index.php?option=com_simplemembership&format=raw',
        data: {
            task: "socialLogin",
            userInfo: userInfo,
            network: socialName
        },
        success: function(data){
            var form = document.createElement("form");
            var element1 = document.createElement("input"); 
            var element2 = document.createElement("input");  

            form.method = "POST";
            form.action = "index.php?option=com_users&task=user.login";   

            element1.value=data.user_login;
            element1.name="username";
            form.appendChild(element1);  

            element2.value=data.user_pass;
            element2.name="password";
            form.appendChild(element2);
            
            var wrapper= document.createElement('div');
            wrapper.innerHTML= '<?php echo JHtml::_('form.token'); ?>';
            var element3 = wrapper.firstChild;
            form.appendChild(element3);
            
            var element4 = document.createElement("input");  
            element4.value='<?php echo $return_url; ?>';
            element4.name="return";
            form.appendChild(element4);
            
            document.body.appendChild(form);
            
            form.submit();
        }
    })

  }



</script>
