{literal}
<script>
function validateFrom()
{
  frm = document.getElementById("addUserForm");
  if(frm.userName.value == '') { alert("Введите имя пользователя!"); return false }
  if(frm.Login.value == '') { alert("Укажите логин!"); return false }
  if(!(frm.uId.value > 0) && (frm.Password.value !== frm.cPassword.value || frm.Password.value == '')) { alert("Пароли не совпадают или пусты!"); return false }
  if((frm.Password.value !== '' || frm.cPassword.value !== '') && (frm.Password.value !== frm.cPassword.value )) { alert("Пароли не совпадают!"); return false }
  return true;
}
</script>
{/literal}

<div id="secondary">
    <div id="sidebar_content" class="clearfix">
    <h1>Пользователи <a href="property[new].xml"><img src="/img/icons/add.png" /> добавить</a></h1>
    {user_manager action='listUsers'}
    <ul class="menu">
{foreach from=$Users item="User" key='UID'}
        <li>
            <a class="delete" href="remove[{$UID}].xml" onclick="return confirm_delete(this.title)" title='Удалить'>
                <img src="/img/icons/cross.png" />
            </a>
            <a class="name" href="property[{$UID}].xml"><img src="/img/icons/user.png" />{$User.Login}</a>
        </li>     
{/foreach}
	</ul>
    </div>
</div>

<hr/>

<div id="container">
  <div id="content" class="clearfix">


{user_manager action='Edit'}

{$user_manager.return}

<div id="cardconteiner"  class="clearfix">

<div id="headercard">
  <h1>Профиль пользователя</h1>
</div>

<form enctype="multipart/form-data" method="post" action="">

            	<input id="UID" 
                type="hidden"
                class="field text full"
                name="User[UID]" 
                value="{$User.UID}"
				/>
                
  <div class="control">
      <ul>
        {*<li>
          <label class="desc"> Фотокарточке:</label>
          <div>
            <div class="holder">
            <span class="edge"></span> 
            <span class="container"><img src="/img/img1.jpg"/></span></div>
          </div>
        </li>*}
        <li>
        {*<div>
          <label class="desc">Атрибуты</label><br />
          <span>
            <input id="cField12" 
          	name="user" 
          	class="checkbox" type="checkbox" 
            {if $Item.ismain}checked{/if}            
          	value="1"  />
            <label class="choice" for="cField12">Скрывать имя</label> 
        </span>
		<span>
			<input id="access1" 
			name="access1" 
	   		class="field checkbox" type="checkbox" 
            {if $User.access[$key]} checked="checked"{/if}
		    value="true" />
			<label class="choice" for="access1">Скрывать контакты</label>
		</span>
        </div>*}<br />

        <div>
        <label class="desc">Телефон</label>
            <input id="Phone"
                name="User[Phone]"
                class="field text full"
                size="30"
                type="text"
                maxlength="30"
                value="{$User.Phone}"  />
            <label for="phone_town"> </label>
        </div>
        <div>
        <label class="desc">Email</label>
        
            <input id="Email" 
                class="field text full"
                name="User[Email]" 
                tabindex="11"
                type="text" maxlength="255" value="{$User.Email}" /> 
        </div>
        <div><label class="desc">www:</label>
                <input id="URL" 
                class="field text full"
                name="User[URL]"
                value="{$User.URL}"
				/>
        </div>
        {*<div><label class="desc">Уровень:</label>
                <input id="Rang" 
                class="field text full"
                name="User[Rang]"
                value="{$User.Rang|default:500}"
				/>
                <label for="Rang">доступ (0-999)</label>
        </div>*}
         </li>
         {*<li>
         	<label class="desc">Группы пользователя:</label>
            <div>
                <select id="usergroup"
                class="field select firefox full" name="User[GID]">
                {foreach from=$User.GID item='Group'}
                <option value="{$Group.GID}"{if $Group.selected} selected{/if}>{$Group.Name}</option>
                {/foreach}
                </select>
                <label for="usergroup">Родная группа</label>
            </div>
         </li>
         <li>
         	<label class="desc">Также включить юзера в группы:</label>
         {foreach from=$User.GIDs item='Group'}
          <div>
            <input id="group{$Group.GID}" 
          	name="User[GIDs][]" 
          	class="checkbox" type="checkbox"       
          	value="{$Group.GID}" {if $Group.selected} checked{/if} />
            <label class="choice" for="group{$Group.GID}">{$Group.Name}</label> 
          </div>
         {/foreach}
         </li>*}         
      </ul>
  </div>
  
<div class="mainform clearfix">
    <div class="contentform ">
     
    <ul>
	<li>
        <div class="info">
            <h2>Пользователь: {$User.Name} {$User.Surname}</h2>
            <p>Личная информация</p>
        </div>
    </li>
  
    <li>
        <label class="desc">Логин</label>
        <span>
            <input id="Login" 
                name="User[Login]"
                class="field text" size="30" 
                value="{$User.Login}"  />
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
                value="{$User.Name}"  />
            <label for="Name">Имя</label>
        </span>
        
        <span>
            <input id="Surname" 
                name="User[Surname]"
                class="field text" size="40" 
                value="{$User.Surname}"  />
            <label for="Surname">Фамилия</label>
        </span>
	</li>	
    <li>
        <label class="desc">Должность</label>
        <div>
            	<input id="Post" 
                class="field text full"
                name="User[Post]" 
                value="{$User.Post}"
				/>
        </div>
	</li>
      				
    <li>
        <label class="desc">О себе</label>
        <div>
                <textarea id="About" 
                class="field textarea full"
                name="User[About]" 
                rows="10" cols="50" >{$User.About}</textarea>
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