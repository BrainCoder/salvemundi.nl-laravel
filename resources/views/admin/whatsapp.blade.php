@extends('layouts.appmin')
@section('content')
<div class="row adminOverlap center">
    @if(session()->has('information'))
        <div class="alert alert-primary">
            {{ session()->get('information') }}
        </div>
    @endif
<div class="col-md-12 center">

    <div class="table-responsive center" >

        <table
               id="table"
               data-toggle="table"
               data-search="true"
               data-sortable="true"
               data-pagination="true"
               data-show-columns="true">
            <thead>
                <tr class="tr-class-1">
                    <th data-field="title" data-sortable="true" data-width="250">Groep naam</th>
                    <th data-field="content" data-sortable="true">Link</th>
                    <th data-field="imgPath" data-sortable="true" data-width="250">Beschrijving</th>
                    <th data-field="delete" data-sortable="false">Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($whatsappLinks as $whatsappLink)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $whatsappLink->name }}">{{ $whatsappLink->name }}</td>
                            <td data-value="{{ $whatsappLink->link }}">{{ $whatsappLink->link }}</td>
                            <td data-value="{{ $whatsappLink->description }}">{{ $whatsappLink->description }}</td>
                            <td data-value="{{ $whatsappLink->id }}"><form method="post" action="/admin/whatsappLinks/delete">@csrf<input type="hidden" name="id" value="{{ $whatsappLink->id }}"><button type="submit" class="btn btn-danger">Verwijderen</button></form></td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<div class="row center adminOverlap">
<div id="contact" class="col-md-6">
@if(session()->has('message'))
<div class="alert alert-primary">
    {{ session()->get('message') }}
</div>
@endif
<form action="/admin/whatsappLinks/store" method="post">
    @csrf
    <br>
    <h2 class="h2">WhatsApp link aanmaken</h2>

    <div class="form-group">
        <label for="Achternaam">Groep naam</label>
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" name="name" placeholder="Naam...">
    </div>

    <div class="form-group">
        <label for="voornaam">Link</label>
        <input class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" value="{{ old('link') }}" id="link" name="link" placeholder="Link...">
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Beschrijving</label>
        <textarea type="textarea" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" placeholder="Beschrijving...">{{{ old('description') }}}</textarea>
    </div>

    <div class="form-group">
        <br>
        <input class="btn btn-primary" type="submit" value="Versturen">
    </div>
</form>
</div>
</div>
@endsection
