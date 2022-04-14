<main class="container">
    <form action="/addGoodsAction" method="POST">
        @csrf
        <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email[]" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" name="email[]" id="pwd">
            </div>
        </div>
        <div class="form-inline justify-content-between">
            <button type="button" class="btn btn-secondary">添加</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>