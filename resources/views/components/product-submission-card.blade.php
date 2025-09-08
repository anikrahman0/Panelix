<div class="card sticky-pub">
    <div class="card-header">
        <h5 class="card-title">{{$cardLabel}}</h5>
    </div>
    <div class="card-body">
        <button type="submit" name="status" value="1" class="btn btn-sm btn-primary mb-2">{{$submitLabel}}</button>
        <button type="submit" name="status" value="2" class="btn btn-sm btn-danger mb-2 draft-btn">{{$draftLabel}}</button>
        <a href="" class="btn btn-sm btn-light mb-2">{{$discardLabel}}</a>
    </div>
</div>