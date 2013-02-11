<div id="container">
  <div id="content" class="nosidebar clearfix">

<form enctype="multipart/form-data" method="post">
  <ul>
     <li class="rightHalf">

        	<div class="info">
            	<h2>Пользователи принадлежащие к группе</h2>
            </div>  
	<ul>
    	<li>Юзер 1</li>
    	<li>Юзер 2</li>
    	<li>Юзер 3</li>
    	<li>Юзер 4</li>                        
    </ul>

  </li> 
  <li class="leftHalf">
         	<div class="info">
            	<h2>Группы пользователей</h2>
            </div>   
  </li> 
  {user_manager action='listGroups'}
  {foreach from=$Groups item='Group'}
  <li class="leftHalf">
  <div class="half left"><label class="desc">Группа {$Group.GID}: {$Group.Description}</label>
    <input id="group" 
      name="Group[{$Group.GID}][Name]"
      class="field text full" size="" 
      value="{$Group.Name}" /><input type="image" src="/img/icons/group_edit.png" style="position: absolute;">
  </div>
  <div class="right half">
  	{$Group.membs} пользователей
  </div>
  
  </li>{/foreach}   
   <li class="buttons">
   	<button type="submit" class="positive "><img src="/img/icons/tick.png" alt="" /> Сохранить</button> 
   </li>
</ul>
</form>

  </div>
</div>