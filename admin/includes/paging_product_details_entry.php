<?php
echo "<li>
        <a href=\"?id=" . $entry_id . "&page=1\">&laquo;</a>
    </li>";
for ($i = 1; $i <= $totalPages; $i++) {
    if ($i != $currentPage) {
        echo "<li><a href=\"?id=" . $entry_id . "&page=" . $i . "\">" . $i . "</a></li>";
    } else {
        echo "<li><a class=\"active\" href=\"?id=" . $entry_id . "&page=" . $i . "\">" . $i . "</a></li>";
    }

}
echo "<li>
        <a href=\"?id=" . $entry_id . "&page=$totalPages\">&raquo;</a>
    </li>";
?>