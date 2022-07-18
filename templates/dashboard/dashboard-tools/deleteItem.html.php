<section class="dashboard__delete-category container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">Delete Item</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__category-details-wrapper">
        <div class="dashboard__tool dashboard__delete-category-wrapper">
            <p class="h2 h2--primary rounded--left-only">Are you sure?</p>
            <form action="<?= $urls["dashboard"]; ?>?tool=delete-item&item-id=<?= $item->getItemID(); ?>" method="POST" class="dashboard__delete-category-form" id="delete-item-form" novalidate>
               <p class="dashboard__delete-warning">This will permanently remove the item '<?= $item->getItemName(); ?>' from the website. Are you sure you want to proceed?</p>
               <div class="dashboard__delete-options">
                   <input type="submit" name="delete-item" class="outline--error rounded" id="delete-item" value="I understand the risks, please delete the item">
                   <a href="<?= $urls["dashboard"]; ?>" class="filled rounded" name="go-back" id="go-back" autofocus>Return to Dashboard</a>
               </div>
            </form>
        </div>
    </div>
</section>