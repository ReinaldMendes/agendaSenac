requisições:

-requer informações com o objetivo de armazenar em uma midia(arquivo)

<React-native>
    GET - PEGAR informações
    -requisição para pegar a lista de contatos ou um contato especifico
    POST - ENVIA informações / adiciona informações no socket_import_stream
    - requisição para inserir um novo connection_aborted
    PUT -  ATUALIZAR  as informações
    - requisição para atualizar informações de um contato 
    DELETE - EXCLUIR  as informações
    -requisição para excluir um contato.

    resttesttest.com

    JSON - javascript Object Notation (Atributo - valor)
    - Trabalha com o conceito de objetos e arrays 
    {
        "escola": "Senac",
        "proprietario":"Comércio",
        "ano_fundaçao": 1994
        "alunos":[{
            "nome": "Nicolas",
            "notas": [9,5]
        },
        {
            "nome": "Reinald",
            "notas":[9, 9.5]
        };
        ]
    }

    sincrona:
    - 1 JSON
    Enquanto este json não terminar a execução, não passará para o proximo arquivo json.
    assincrona:
    -1 JSON executa
    Enquanto isso já se inicia a execução de outro arquivo JSON simultaneamente.

</React-native>