# Imobi
### Sistema de gestão de locação para imobiliarias

---

Requisito:
* Ao salvar um contrato gerar automaticamente as parcelas de repasse e mensalidade.

---

* Versão do servidor: 10.4.11-MariaDB - mariadb.org binary distribution;
* PHP/7.4.6 Apache/2.4.43 (Win7-64);
* MySQL server version: 5.5.5-10.4.11-MariaDB;
* HeidiSQL Versão: 11.0.0.5919;
* Arquivo do banco de dados disponivel no diretório raiz.

---

* Sistema efetua cadastro, edita e lista as entidades locatário, locador, imóvel e contrato;
* Ao criar um contrato é gerado 12 parcelas de mensalidades ( dia vencimento = 1 ) e
também é gerado 12 parcelas de repasses ( dia do vencimento é a mesma informada no cadastro do locador );
* É possivel marcar uma parcela como realizado.

---

![2022-11-17 16 23 19](https://user-images.githubusercontent.com/106672970/202539617-017ff4e2-ae74-48b5-ab38-b5452324b63c.jpg)
