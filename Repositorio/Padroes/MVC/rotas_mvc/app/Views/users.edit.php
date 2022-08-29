<h2>Edição de Usuário</h2>
 
<form action="/edit" method="post">
    <label for="name">Nome: </label>
     
    <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>">
 
    <label for="email">Email: </label>
     
    <input type="text" name="email" id="email" value="<?php echo $user['email']; ?>">
      
    Gênero:
     
    <input type="radio" name="gender" id="gener_m" value="m" <?php if ($user['gender'] == 'm'): ?> checked="checked" <?php endif; ?>>
    <label for="gener_m">Masculino </label>
    <input type="radio" name="gender" id="gener_f" value="f" <?php if ($user['gender'] == 'f'): ?> checked="checked" <?php endif; ?>>
    <label for="gener_f">Feminino </label>
      
    <label for="birthdate">Data de Nascimento: </label>
     
    <input type="text" name="birthdate" id="birthdate" placeholder="dd/mm/YYYY" value="<?php echo dateConvert($user['birthdate']) ?>">
 
    <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
 
    <input type="submit" value="Cadastrar">
</form>
