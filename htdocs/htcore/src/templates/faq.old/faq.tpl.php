{loader src='forms.css' type='css' base='/css/'}
{loader src='faq.css, navigation.css' type='css' base='/css/'}

{if $Faq.action.added}<h3>Ваш вопрос отправлен, спасибо.</h3>
  <a href="/faq/">Перейти к вопросам</a>
  {registry target='Exchange.Send'}
  {sendmail send="true" return="false" mailto=$registry.rEmail subject="Добавлен новый вопрос на сайте"}<h1>Новый вопрос на сайте.</h1>
  <p>
    <strong>От:</strong>
    {$cDeep.post.Name} [{$cDeep.post.email}]
  </p>
  {$cDeep.post.Question}
  {/sendmail}
{else}
 
  {capture name='msgs' assign="msgs"}
  {section name=i loop=$Faq.questions}
  
  <div class="comment">
    <div class="message">{$Faq.questions[i].Question}</div>
	<div class="from">
        Вопрос от <strong>{$Faq.questions[i].Name|htmlall}</strong>&nbsp;
        <small>{$Faq.questions[i].date}</small>
    </div>
	{if $Faq.questions[i].Answer}
	<div class="message answer">{$Faq.questions[i].Answer}</div>
    <div class="from answer">
        Ответ
    </div>	   
    {/if}
  </div>
    
  {/section} 
  {/capture}
  <form method="POST" name="AddQuestion">
    <input type="hidden" name="action" value="addQuestion">
    {if $Faq.action.emptyName || $Faq.action.emptyQuestion || $Faq.action.emptyCode || $Faq.action.emptyEmail}
    <div class=info>
      <h2>Ошибка в заполнении формы</h2>
    </div>
    <div id="errorMsg">
      <ol>
        {if $Faq.action.emptyName}<li>Пожалуйста заполните поле <strong>имя</strong></li>
        {/if}
        {if $Faq.action.emptyQuestion}<li>Вы не ввели <strong>текст сообщения</strong></li>
        {/if}
        {if $Faq.action.emptyEmail}<li>Вы ввели пустой либо некорректный <strong>e-mail</strong></li>
        {/if}
        {if $Faq.action.emptyCode}<li>Неверен <strong>код с картинки </strong></li>
        {/if}
      </ol>
    </div>
    {else}
    <div class=info>
      <h2>Задайте свой вопрос</h2>
    </div>
    {/if}
    <ul style="margin:0; padding:0;">
      <li class="left twothird ">
        <div class="{if $Faq.action.emptyQuestion}error{/if}">
          <label class="desc">
            <span class="req">*</span>Ваше сообщение:
          </label>
          <textarea name="Question" rows="13" class="full field textarea" id="respond">{$Faq.return.Question}</textarea>
          <label>
            Все поля отмеченные звездочкой "*" обязательны для заполнения
          </label>
        </div>
      </li>
      <li class="right third">
        <div {if $Faq.action.emptyName}class="error"{/if}>
          <label class="desc" for="Name">
            <span class="req">*</span>Имя
          </label>
          <input class="full text field" type="text" name="Name" value="{$Faq.return.Name}">
        </div>
      </li>
      <li class="right third">
        <div {if $Faq.action.emptyEmail}class="error"{/if}>
          <label class="desc" for="email">
            <span class="req">*</span>Email
          </label>
          <input class="field text full" type="text" name="email" value="{$Faq.return.email}">
          <label>
            (на сайте будет скрыт)
          </label>
        </div>
      </li>
      <li class="right third">
        <div {if $Faq.action.emptyCode}class="error"{/if}>
          <label class="desc" for="code">
            <span class="req">*</span>Код
          </label>
          <input class="field text full" type="text" name="code"/>
          <img src="/antibot.php" alt="код"/>
        </div>
      </li><li class="right third">
        <div class="buttons">
          <button name="ok1" type="submit">
            Отправить
          </button>
        </div>
      </li>
    </ul>
  </form>
  <br class="clear" />
  &nbsp;
  {/if}
  {if $Faq.questions}
  <div id="block_comments">
    {include file="file:paging.tpl.php"}
    {$msgs}
    {include file="file:paging.tpl.php"}
  </div>
  {/if}

