<h1>Edit Book</h1>
<form method='post' action='#'>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter a Name" name="name" value ="<?php if (isset($book->name)) echo $book->name;?>">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" placeholder="Enter a description" name="description" value ="<?php if (isset($book->description)) echo $book->description;?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>