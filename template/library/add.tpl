<form method="post" class="add">
    <input type="hidden" name="id" value="<?=$id ?>"/>
    <div>Name:</div>
    <div><input type="text" name="name" value="<?=$name ?>" /></div>
    <div>Description:</div>
    <div><textarea name="description"><?=$description ?></textarea></div>
    <div>Date:</div>
    <div><input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($date));?>" /></div>
    <div><input type="submit" value="Add" /></div>
    <div><a class="go" href="/">Go to back!</a></div>
</form>