<?php  if (count($errors) > 0) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <p style="margin-bottom: 65px; margin-top: -50px;color: tomato;"><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>