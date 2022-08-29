<section>
    <h1>Users</h1>
    <a href="?r=/out">Reset</a>
</section>

<form action="?r=/list" method="POST">
    <label for="user">User: </label>
    <input type="text" name="user" id="user"/>
    <button>Send</button>
</form>

<small><?php echo count($vars['users']) ?> users.</small>
<ul>
    <?php foreach ($vars['users'] as $user): ?>
        <li><?php echo $user ?></li>
    <?php endforeach ?>
</ul>