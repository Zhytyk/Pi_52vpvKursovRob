<form method="post" class="add">
    <input type="hidden" name="id" value="<?=$id ?>"/>
    <input type="hidden" name="library_id" value="<?=$id_lib ?>" />
    <div>Name:</div>
    <div><input type="text" name="name" value="<?=$name ?>" /></div>
    <div>Description:</div>
    <div><textarea name="description"><?=$description ?></textarea></div>
    <div>Date:</div>
    <div><input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($date));?>" /></div>
    <div><button>Додати</button></div>
    <div><a class="go" href="/section/index/<?=$id_lib ?>">Go to back!</a></div>
</form>