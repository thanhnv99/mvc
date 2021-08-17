<h1>Books</h1>
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
        <a href="<?php echo WEBROOT ?>books/create/" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new book</a>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <?php
        foreach ($books as $book)
        {
            echo '<tr>';
            echo "<td>" . $book->getId() . "</td>";
            echo "<td>" . $book->getName() . "</td>";
            echo "<td>" . $book->getDescription() . "</td>";
            echo "<td class='text-center'><a class='btn btn-info btn-xs' href='".WEBROOT."books/edit/" . $book->getId() . "' >
            <span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='".WEBROOT."books/delete/" . $book->getId() . "' class='btn btn-danger btn-xs' onclick=\"return confirm('are you sure?')\" ><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>