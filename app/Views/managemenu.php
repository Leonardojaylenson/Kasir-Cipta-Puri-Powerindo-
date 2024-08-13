<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menus</title>
    <link rel="stylesheet" href="<?= base_url('path/to/bootstrap.css') ?>">
</head>
<body>
    
    <div class="container">
        <h1>Manage Menus</h1>
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('home/updateMenuVisibility') ?>" method="post">
            <?= csrf_field() ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Tipe Menu</th>
                        <th>Show for Level 3</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($menuss as $menu): ?>
                        <tr>
                            <td><?= esc($menu->title) ?></td>
                            <td><?= esc($menu->tipe_menu) ?></td>
                            <td>
                                <!-- Hidden input to handle unchecked checkboxes -->
                                <input type="hidden" name="menus[<?= esc($menu->id) ?>]" value="0">
                                <!-- Checkbox for visible items -->
                                <input type="checkbox" name="menus[<?= esc($menu->id) ?>]" value="1" <?= $menu->show_for_level_3 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script src="<?= base_url('path/to/bootstrap.js') ?>"></script>
</body>
</html>
