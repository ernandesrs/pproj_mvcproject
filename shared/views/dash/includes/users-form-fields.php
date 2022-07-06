<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="first_name">Nome:</label>
        <input class="form-control" type="text" name="first_name" id="first_name" value="<?= input_value("first_name", $user ?? null) ?>">
    </div>
</div>

<div class="col-12 col-sm-6">
    <div class="form-group">
        <label for="last_name">Sobrenome:</label>
        <input class="form-control" type="text" name="last_name" id="last_name" value="<?= input_value("last_name", $user ?? null) ?>">
    </div>
</div>

<div class="col-12 col-md-6 col-xl-5">
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email" id="email" value="<?= input_value("email", $user ?? null) ?>">
    </div>
</div>

<div class="col-12 col-md-6 col-xl-3">
    <div class="form-group">
        <label for="username">Usuário:</label>
        <input class="form-control" type="text" name="username" id="username" value="<?= input_value("username", $user ?? null) ?>">
    </div>
</div>

<div class="col-12 col-xl-2">
    <div class="form-group">
        <label for="gender">Gênero:</label>
        <select class="form-control" name="gender" id="gender">
            <option value="n">Escolha</option>
            <?php foreach (\App\Models\User::ALLOWED_GENDERS as $gender) : ?>
                <option value="<?= $gender ?>" <?= input_value("gender", $user ?? null) == $gender ? "selected" : null ?>>
                    <?= get_term("user.genders.gender_{$gender}") ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="col-12 col-xl-2">
    <div class="form-group">
        <label for="level">Nível:</label>
        <select class="form-control" name="level" id="level">
            <?php foreach (\App\Models\User::ALLOWED_LEVELS as $level) : ?>
                <option value="<?= $level ?>" <?= input_value("level", $user ?? null) == $level ? "selected" : null ?>>
                    <?= get_term("user.levels.level_{$level}") ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="col-12">
    <div class="form-group">
        <label for="photo">Foto:</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="photo" name="photo">
            <label class="custom-file-label" for="photo" name="photo">Escolher arquivo</label>
        </div>
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label for="password">Senha:</label>
        <input class="form-control" type="password" name="password" id="password" autocomplete="new-password">
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label for="password_confirm">Confirmar senha:</label>
        <input class="form-control" type="password" name="password_confirm" id="password_confirm">
    </div>
</div>