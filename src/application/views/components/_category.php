<?php foreach( $categories as $category) : ?>
<li class="list-group-item" data-nodeid="0">

    <?php if(count($category->children) > 0):?>
    <button class="btn btn-link btn-tree"
            type="button"
            data-toggle="collapse"
            data-target="#collapseId<?= $category->id ?>">
    <span class="icon expand-icon glyphicon glyphicon-plus"></span>
    </button>
    <?php endif?>

    <span class="icon node-icon"></span><a href="/category/show/<?= $category->id?>"><?= $category->name?></a>
    <?php if(count($category->children) > 0): ?>
    <ul class="list-group collapse" id="collapseId<?= $category->id ?>" aria-expanded="false">
        <?php $this->view('components/_category',[
            'categories' =>  $category->children
        ])?>
    </ul>
    <?php endif?>
    <div class="btn-group btn-group-sm ml-5" role="group" aria-label="Basic example">
        <button type="button"
                data-toggle="modal"
                data-target="#modalAddCategory"
                data-parent-id="<?= $category->id?>"
                title="Add"
                class="btn btn-link add-category p-2">
            <span class="icon expand-icon glyphicon glyphicon-plus-sign"></span>
        </button>

        <button type="button"
                data-toggle="modal"
                data-target="#modalEditCategory"
                data-parent-id="<?= $category->parent_id?>"
                data-id="<?= $category->id?>"
                data-name="<?= $category->name?>"
                data-desc="<?= $category->desc?>"
                class="btn btn-link edit-category p-2"
                title="Edit">
            <span class="icon expand-icon glyphicon glyphicon-edit text-warning"></span>
        </button>
        <?php echo form_open('/category/delete',['method' => 'post', 'class' => 'd-inline-block'])?>
        <button type="submit"
                data-toggle="tooltip" data-placement="top" title="Delete"
                         class="btn btn-link remove-category p-2">
            <span class="icon expand-icon glyphicon glyphicon-remove text-danger"></span>
        </button>
        <?php echo form_input([
            'name' => 'id',
            'type' => 'hidden',
            'value' => $category->id
        ]); ?>
        <?php echo form_close(); ?>
    </div>

</li>
<?php endforeach?>