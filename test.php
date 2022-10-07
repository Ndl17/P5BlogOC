<?php



try {
  throw new Exception('mon exception');
  echo "je continue"
} catch (\Exception $e) {
  die ($exception->getMessage());
}
 ?>
