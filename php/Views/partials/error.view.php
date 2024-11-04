<?php if (!empty($_SESSION['error'])): ?>
    <div class="error-message">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); // Clear the error after displaying it ?>
<?php endif; ?>

<style>
    .error-message {
        color: #D8000C;
        background-color: #FFD2D2;
        border: 1px solid #D8000C;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 15px;
        font-size: 16px;
        text-align: center;
        font-family: 'Roboto', sans-serif;
    }
</style>