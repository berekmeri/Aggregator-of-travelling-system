  <footer class="footer">
    <div class="footer-inner">
      <div class="footer-copyright">
        &copy; <?= date('Y') ?> TravelSys. Minden jog fenntartva.
      </div>
    </div>
  </footer>

  <?php
    $page = $system->router->getCurrentPage();
  ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="module" src="<?= PROJECT_URL ?>/layouts/assets/scripts/main.js"></script>

  <?php if (file_exists(JS_PATH . $page . '.js')): ?>
    <script type="module" src="<?= PROJECT_URL ?>/layouts/assets/scripts/<?= $page ?>.js"></script>
  <?php endif; ?>
</body>
</html>