<!-- app/Views/templates/my_pager_template.php -->
<ul class="pagination">
    <?php if ($pager->hasPreviousPage()): ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPreviousPage() ?>">Previous</a>
        </li>
    <?php endif; ?>

    <?php foreach ($pager->links() as $link): ?>
        <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
            <?php // var_dump($link); die();
            ?>
            <a class="page-link" href="<?=  $link['uri'] ?>"><?= $link['title'] ?></a>
        </li>
    <?php endforeach; ?>

    <?php if ($pager->hasNextPage()): ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNextPage() ?>">Next</a>
        </li>
    <?php endif; ?>
</ul>
