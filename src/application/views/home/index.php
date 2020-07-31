<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3">Categories</h3>
            <ul class="list-group">
                <?php if(empty($categories)): ?>
                    No categories
                <?php endif?>

                <!--Выводим только родительские комментарии parent_id = 0 -->
                <?php $this->view('components/_category', ['categories' => $categories]) ?>

                <?php $this->view('components/_modalAddCategory')?>
                <?php $this->view('components/_modalEditCategory')?>
                <button type="button"
                        data-toggle="modal"
                        data-target="#modalAddCategory"
                        data-parent-id="0"
                        title="Add"
                        class="btn btn-primary add-category m-3">
                    <span class="icon expand-icon glyphicon glyphicon-plus"></span> New Category
                </button>
            </ul>
        </div>
    </div>
</div>


