{forgotpassword}

{if !$sended}
<form method='post'>
Введите email:
<input type='text' name='Email'>
<input type='submit' name='recover' value='Восстановить'>
</form>
{/if}