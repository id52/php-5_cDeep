<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:17
         template file:sadm/users/users.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'user_manager', 'file:sadm/users/users.tpl.php', 18, false),)), $this); ?><?php echo '
<script>
function validateFrom()
{
  frm = document.getElementById("addUserForm");
  if(frm.userName.value == \'\') { alert("Введите имя пользователя!"); return false }
  if(frm.Login.value == \'\') { alert("Укажите логин!"); return false }
  if(!(frm.uId.value > 0) && (frm.Password.value !== frm.cPassword.value || frm.Password.value == \'\')) { alert("Пароли не совпадают или пусты!"); return false }
  if((frm.Password.value !== \'\' || frm.cPassword.value !== \'\') && (frm.Password.value !== frm.cPassword.value )) { alert("Пароли не совпадают!"); return false }
  return true;
}
</script>
'; ?>


<div id="secondary">
    <div id="sidebar_content" class="clearfix">
    <h1>Пользователи <a href="property[new].xml"><img src="/img/icons/add.png" /> добавить</a></h1>
    <?php echo cDeep_function_user_manager(array('action' => 'listUsers'), $this);?>

    <ul class="menu">
<?php $_from = $this->_tpl_vars['Users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['UID'] => $this->_tpl_vars['User']):
?>
        <li>
            <a class="delete" href="remove[<?php echo $this->_tpl_vars['UID']; ?>
].xml" onclick="return confirm_delete(this.title)" title='Удалить'>
                <img src="/img/icons/cross.png" />
            </a>
            <a class="name" href="property[<?php echo $this->_tpl_vars['UID']; ?>
].xml"><img src="/img/icons/user.png" /><?php echo $this->_tpl_vars['User']['Login']; ?>
</a>
        </li>     
<?php endforeach; endif; unset($_from); ?>
	</ul>
    </div>
</div>

<hr/>

<div id="container">
  <div id="content" class="clearfix">


<?php echo cDeep_function_user_manager(array('action' => 'Edit'), $this); echo $this->_tpl_vars['user_manager']['return']; ?>


<div id="cardconteiner"  class="clearfix">

<div id="headercard">
  <h1>Профиль пользователя</h1>
</div>

<form enctype="multipart/form-data" method="post" action="">

            	<input id="UID" 
                type="hidden"
                class="field text full"
                name="User[UID]" 
                value="<?php echo $this->_tpl_vars['User']['UID']; ?>
"
				/>
                
  <div class="control">
      <ul>
                <li>
        <br />

        <div>
        <label class="desc">Телефон</label>
            <input id="Phone"
                name="User[Phone]"
                class="field text full"
                size="30"
                type="text"
                maxlength="30"
                value="<?php echo $this->_tpl_vars['User']['Phone']; ?>
"  />
            <label for="phone_town"> </label>
        </div>
        <div>
        <label class="desc">Email</label>
        
            <input id="Email" 
                class="field text full"
                name="User[Email]" 
                tabindex="11"
                type="text" maxlength="255" value="<?php echo $this->_tpl_vars['User']['Email']; ?>
" /> 
        </div>
        <div><label class="desc">www:</label>
                <input id="URL" 
                class="field text full"
                name="User[URL]"
                value="<?php echo $this->_tpl_vars['User']['URL']; ?>
"
				/>
        </div>
                 </li>
                  
      </ul>
  </div>
  
<div class="mainform clearfix">
    <div class="contentform ">
     
    <ul>
	<li>
        <div class="info">
            <h2>Пользователь: <?php echo $this->_tpl_vars['User']['Name']; ?>
 <?php echo $this->_tpl_vars['User']['Surname']; ?>
</h2>
            <p>Личная информация</p>
        </div>
    </li>
  
    <li>
        <label class="desc">Логин</label>
        <span>
            <input id="Login" 
                name="User[Login]"
                class="field text" size="30" 
                value="<?php echo $this->_tpl_vars['User']['Login']; ?>
"  />
            <label for="login">Не менее 4х символов</label>
        </span>
    </li>  
  
	<li>
        <label class="desc">Пароль</label>
    
        <span>
            <input id="Passwd" 
                name="User[Passwd]"
                class="field text" size="30"
                type="password"
                value=""  />
            <label for="Passwd">Не менее 4х символов</label>
        </span>
        
        <span>
            <input id="RePasswd" 
                name="User[RePasswd]"
                class="field text" size="30" 
                type="password"
                value=""  />
            <label for="RePasswd">Повторите пожалуйста</label>
        </span>
	</li>	  
  
  
	<li>
        <label class="desc">Личная информация</label>
    
        <span>
            <input id="Name" 
                name="User[Name]"
                class="field text" size="20" 
                value="<?php echo $this->_tpl_vars['User']['Name']; ?>
"  />
            <label for="Name">Имя</label>
        </span>
        
        <span>
            <input id="Surname" 
                name="User[Surname]"
                class="field text" size="40" 
                value="<?php echo $this->_tpl_vars['User']['Surname']; ?>
"  />
            <label for="Surname">Фамилия</label>
        </span>
	</li>	
    <li>
        <label class="desc">Должность</label>
        <div>
            	<input id="Post" 
                class="field text full"
                name="User[Post]" 
                value="<?php echo $this->_tpl_vars['User']['Post']; ?>
"
				/>
        </div>
	</li>
      				
    <li>
        <label class="desc">О себе</label>
        <div>
                <textarea id="About" 
                class="field textarea full"
                name="User[About]" 
                rows="10" cols="50" ><?php echo $this->_tpl_vars['User']['About']; ?>
</textarea>
        </div>
	</li>
    <li class="buttons">
          <button id="saveForm" class="positive" type="submit"><img src="/img/icons/tick.png"/> Применить</button>
    </li>
    </ul>
    
   </div><br />
</div> 
</form>
</div>

     
    </div>
</div>