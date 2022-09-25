<div class="form-group">
    <label for="username">Nombre usuario</label>
    <input type="text" class="form-control form-control-sm" id="username" wire:model="user.username"
        placeholder="Nombre de usuario">
</div>
<div class="form-group">
    <label for="name">Nombre y apellido</label>
    <input type="text" class="form-control form-control-sm" id="name" wire:model="user.name"
        placeholder="Nombre y apellido">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control form-control-sm" id="email" wire:model="user.email"
        placeholder="Email">
</div>
<div class="form-group">
    <label for="phone">Teléfono</label>
    <input type="text" class="form-control form-control-sm" id="phone" wire:model="user.phone"
        placeholder="Telefono">
</div>
<div class="form-group">
    <label for="domicile">Domicilio</label>
    <input type="text" class="form-control form-control-sm" id="domicile" wire:model="user.domicile"
        placeholder="Domicilio">
</div>
<div class="form-group">
    <label for="dni">D.N.I.</label>
    <input type="text" class="form-control form-control-sm" id="dni" wire:model="user.dni"
        placeholder="D.N.I.">
</div>
<div class="form-group">
    <label for="password">Contraseña</label>
    <input id="password" class="form-control form-control-sm" wire:model="user.password" type="password"
        name="password" required autocomplete="new-password" placeholder="Contraseña" />
</div>
<div class="form-group">
    <label for="password_confirmation">Repetir contraseña</label>
    <input id="password_confirmation" class="form-control form-control-sm" wire:model="user.password_confirmation"
        type="password" name="password_confirmation" required placeholder="Contraseña" />
</div>
