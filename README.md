# Receitas On-Line

Sistema web de receitas culinárias: cadastro e login de usuários, publicação de
receitas próprias, exploração/busca de receitas de outros usuários e
comentários nas receitas.

## Funcionalidades

- Cadastro e login de usuários (`tela_cadastro.php`, `tela_login.php`)
- Postagem de novas receitas com imagem, ingredientes, tutorial e categoria
  (`postar_receita.php`)
- Edição e exclusão de receitas próprias (`alterar_receita.php`,
  `php/dbatualizar_receita.php`, `php/dbexcluir_receita.php`)
- Exploração/listagem de receitas (`explorar_receitas.php`)
- Visualização detalhada de uma receita (`visualizar_receita.php`)
- Comentários em receitas, incluindo edição e exclusão do próprio comentário
  (`php/dbpostar_comentario.php`, `php/dbatualizar_comentario.php`,
  `php/dbexcluir_comentario.php`)

## Stack

- PHP puro (sem framework), usando a extensão `mysqli`
- MySQL como banco de dados
- HTML/CSS/JS no front-end (Bootstrap 4, Font Awesome, SlickNav, jQuery Nice
  Select — veja `Source/icons.txt` e `CREDITS.txt` para créditos de ícones e
  fotos do template)

## Estrutura do projeto

```
.
├── php/                # Scripts de acesso ao banco (conexão, CRUD)
│   └── dbconex.php      # Conexão MySQL (lê credenciais de variáveis de ambiente)
├── css/, js/, fonts/     # Assets já compilados/extraídos das bibliotecas de terceiros
├── img/                  # Imagens estáticas do template e das receitas
├── Source/               # Material de referência do template (ícones etc.)
├── *.php (raiz)          # Páginas da aplicação (index, login, cadastro, etc.)
└── Query Receitas On-LineHU2.sql  # Script de criação do banco e das tabelas
```

## Configuração

O acesso ao banco de dados é configurado via variáveis de ambiente (não há
mais credenciais hardcoded no código). Veja `.env.example` para a lista de
variáveis esperadas:

| Variável  | Descrição                          | Padrão (fallback local) |
|-----------|-------------------------------------|--------------------------|
| `DB_HOST` | Host do servidor MySQL              | `localhost`              |
| `DB_USER` | Usuário do MySQL                    | `root`                   |
| `DB_PASS` | Senha do MySQL                      | *(vazio)*                |
| `DB_NAME` | Nome do banco de dados              | `receitasonline`         |

Defina essas variáveis no seu ambiente (Apache `SetEnv`, `php.ini`,
Docker, etc.) antes de rodar a aplicação. **Nunca** faça commit de um `.env`
com credenciais reais — o `.gitignore` já ignora `.env` e variações.

## Como rodar localmente

1. **Banco de dados**: crie o banco importando o script SQL incluído no
   repositório:
   ```
   mysql -u root -p < "Query Receitas On-LineHU2.sql"
   ```
   Isso cria o banco `receitasonline` e as tabelas `Usuario`, `Receitas`,
   `Comentarios` e `Imagens`.

2. **Variáveis de ambiente**: configure `DB_HOST`, `DB_USER`, `DB_PASS` e
   `DB_NAME` de acordo com o seu MySQL local (veja `.env.example`). Se
   nenhuma variável for definida, a aplicação usa os padrões de
   desenvolvimento (`localhost` / `root` / senha vazia / `receitasonline`).

3. **Servidor PHP**: a partir da raiz do projeto, suba o servidor embutido do
   PHP (requer PHP com extensão `mysqli` habilitada):
   ```
   php -S localhost:8000
   ```
   Acesse `http://localhost:8000/index.php` no navegador.

## Segurança

- **Senhas com hash bcrypt**: novos cadastros (`php/dbregistra_cadastro.php`)
  salvam a senha usando `password_hash($senha, PASSWORD_DEFAULT)` — nunca em
  texto puro.
- **Migração automática (lazy migration)**: contas antigas que ainda têm a
  senha salva em texto puro continuam funcionando normalmente. No login
  (`php/verificalogin.php`), se `password_verify()` falhar e a senha
  armazenada não parecer um hash válido, o sistema faz um fallback comparando
  a senha digitada diretamente; se baterem, o usuário é autenticado e sua
  senha é automaticamente re-salva no banco já em formato bcrypt. Depois
  desse primeiro login, a conta passa a usar hash normalmente.
- **Pré-requisito de schema**: a coluna `Usuario.senha` precisa comportar um
  hash bcrypt (60 caracteres). O script `Query Receitas On-LineHU2.sql` já
  usa `VARCHAR(255)`; se o banco já existir com `VARCHAR(40)`, rode
  `ALTER TABLE Usuario MODIFY senha VARCHAR(255) NOT NULL;` **antes** de usar
  esta versão do código — caso contrário o hash é truncado e nenhum login
  volta a funcionar.

## Licença

O template visual (HTML/CSS) tem origem em um template comercial da Colorlib;
os termos de atribuição/licença do template estão em `LICENSE-TEMPLATE.txt`.
O código da aplicação (PHP/lógica de negócio) é deste projeto.
