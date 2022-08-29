# 99 Boottles

Este livro é sobre como escrever código com boa relação custo-benefício, fácil de manter e agradável.

Onde antes você otimizava o código para compreensão, agora você se concentra em sua mutabilidade.

Esta é a promessa básica do Design Orientado a Objetos (OOD): se você estiver disposto a aceitar aumentos na complexidade do seu código ao longo de algumas dimensões, será recompensado com diminuições na complexidade em outras. OOD não afirma ser gratuito; simplesmente afirma que seus benefícios superam seus custos.

Dividir uma grande classe em algumas menores força a criação de algo novo para incorporar a relação entre as peças. A injeção de uma dependência transforma o receptor em algo que depende de uma função abstrata em vez de uma classe concreta.

Infelizmente, abstrações são difíceis e, mesmo com a melhor das intenções, é fácil errar. Programadores bem-intencionados tendem a antecipar excessivamente as abstrações, inferindo-as prematuramente a partir de informações incompletas. As abstrações iniciais costumam não estar corretas e, portanto, criam um catch-22. [1] Você não pode criar a abstração certa até compreender totalmente o código, mas a existência da abstração errada pode impedi-lo de fazer isso. Isso sugere que você não deve buscar abstrações, mas, em vez disso, deve resistir a elas até que insistem absolutamente em serem criadas.

Este livro é sobre como encontrar a abstração certa. Este primeiro capítulo começa removendo a névoa da complexidade e definindo o que significa escrever um código simples.

O código que você escreve deve atender a dois objetivos frequentemente contraditórios. Deve permanecer concreto o suficiente para ser compreendido e, ao mesmo tempo, abstrato o suficiente para permitir mudanças.

Evitar duplicação de código.

Responder as perguntas sobre um código:
- Quão difícil é de escrever
- Quão difícil é de entender
- Quão custoso é de alterar


