<form method="POST">
    <input type="hidden" name="id" value="<?=$id ?>" />
    <div>Login</div>
    <div><input type="text" name="login" value="<?=$login ?>" /></div>
    <div>Password</div>
    <div><input type="password" name="password" value="<?=$password ?>"/></div>
    <div>Password confirm</div>
    <div><input type="password" name="password_c" value="<?=$password ?>"/></div>
    <div>Email</div>
    <div><input type="email" name="email" value="<?=$email ?>"/></div>
    <input type="submit" value="Edit" />
</form>
<a href="/user/index">Go to back!</a>