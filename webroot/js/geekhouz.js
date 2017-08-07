		var current_time = (new Date()).getTime() + ((new Date()).getTimezoneOffset() * 60 * 1000 * -1);
		var datas = [];

		$(document).ready(function() {
			
			$('#frmContato').submit(function(){
				$.post('/Contato/envia',$('#frmContato').serialize(),function(data) {
					data = $.parseJSON(data);
					msg = "";
					$('.form-erro').remove();
					if(data.length>0) {
						$.each(data, function(k, v){
							$('#'+v[0]).prev().after('<div class="form-erro">'+v[1]+'&nbsp;<img align="absmiddle" src="/img/icon-erro.png" /></div>');
							console.log(v[0])
						});
					} else {
						document.frmContato.reset();
						alert('Obrigado pelo seu contato!');
					}
				});
				return false;
			});

			atualizaTotalItens();

			$('#icon-carrinho').hover(function(){
				$('#conteudo-carrinho').fadeIn();
				$('#conteudo-carrinho .lista-carrinho').html('<img src="/img/carregando.gif" class="img-carregando" alt="Carregando" title="Carregando informações" />');
				$.post('/Shop/carrinho',function(data) {
					$('#conteudo-carrinho .lista-carrinho').html(data);
				});
			},function(){
				$('#conteudo-carrinho').hide();
			});

			$('#fullpage').fullpage({
				sectionsColor: ['#0787ff', '#ffa734', '#07d9ff', '#ffc807','#49585f' ,'#c3eb24', '#a5a6a7', '#d4004b'],
				anchors: ['inicial', 'acasa', 'servicos', 'agendaesports', 'playerzone', 'localizacao', 'contato', 'login'],
				css3:false,
				menu: '#menu',
				onLeave: function(index, nextIndex, direction){
					$('.container').removeClass('container-open');
					$('.fullpage').removeClass('menu-open');
				}
			});

			$('.bt-menu-trigger').click(function(event){
				event.preventDefault();
				$('.container').toggleClass('container-open');
				$('.fullpage').toggleClass('menu-open');
			});
			
			$('.container nav ul li a body').click(function(){
				$('.container').removeClass('container-open');
			});

			$('#tbl-mesas a').click(function(){
				$('#tbl-mesas a img').remove();
				$(this).append('<img src="/img/check-icon.png" />');
				$('#pz-txt-mesa').val($(this).text());
				$('#dv-controles button').removeAttr("disabled");
			});

			$('#btn-facebook-login').click(function() { facebookLogin(testeFacebookLogin); });

			initAcoesPlayerZone();

		});
		
		function montaSliderHorarioMesa() {
			$.getJSON(
				'/Calendario/getHorariosDisponiveis/'+$('#pz-txt-data').val(),
				function(data) {
					datas = data;
					montaSlide();
				}
			);
			removeValoresReserva();
		}

		function removeValoresReserva() {
			$('.reservaPrecoFinal').hide();
			$('.reservaPrecoFinal .valor, .reservaPrecoFinal .decimal').html('');
		}

		function escreveValoresSlide(startTime, endTime) {
			$('#pz-txt-hora-inicial').val(datas[startTime]);
			$('#pz-txt-hora-final').val(datas[endTime]);
			$( "#time" ).html( "das " + datas[startTime] + " às " + datas[endTime] );
		}

		function verificaValor() {
			$.post('shop/calcula_reserva_hora',$('#frmPlayerZoneShop').serialize(),function(data){
				var ret = $.parseJSON(data);
				var valor = ret.valor.split(",");
				$('.reservaPrecoFinal .valor').html(valor[0]+'<span class="decimal">,'+valor[1]+'</span>');
				$('.reservaPrecoFinal').fadeIn();
			});
		}

		function montaSlide() {
			$("#slider-range").slider({
				range: true,
				min: 0,
				max: datas.length-1,
				values: [0, Math.min(4,datas.length-1)],
				slide: function(event, ui) {
					
					//console.log(ui.values[0]+" -> "+ui.values[1]);
					if(ui.values[1]-ui.values[0] < 4) {
						return false;
					}

					escreveValoresSlide(ui.values[0],ui.values[1]);
				},
				stop: function(event, ui) {
					verificaValor();
				}
			});

			var v = $("#slider-range").slider("values");
			escreveValoresSlide(v[0],v[1]);

		}

		function atualizaTotalItens(itens) {
			if(itens==undefined) {
				$.post('/shop/informacoes_carrinho',function(data){
					var t = $.parseJSON(data);
					$('#icon-carrinho .badge').html(t.itens);
				});
			} else {
				$('#icon-carrinho .badge').html(itens);
			}
		}

		function initAcoesPlayerZone() {

			$('#frmPlayerZoneShop').submit(function(){
				return false;
			});

			$('#btn-adicionar').click(function(){
				$.post('shop/reserva_mesa',$('#frmPlayerZoneShop').serialize(),function(data){
					var t = $.parseJSON(data);
					atualizaTotalItens(t.qtde);
					alert('Reservado!');
					irPasso(1);
				});
			});

			$.post('/Calendario/calendario',function(data) {
				$('#pz-passo-1').html(data);
				$('#pz-passo-1 a').click(function(){
					var dt = $(this).parent().parent().attr('date');
					$('#pz-txt-data').val(dt);
					escreveProgressAtiva(dt,1);
					montaSliderHorarioMesa();
				});
			});

			$('#pz-passo-2 a').click(function(){
				var tipoMesa = $(this).find('span').text();
				$('#pz-txt-tipo-mesa').val(tipoMesa);
				$('#pz-passo-3-tipo-mesa .titulo').html(tipoMesa);
				$('.align-tipo').removeClass().addClass('align-tipo').addClass($(this).find('div').attr('class'));
				verificaValor();
				escreveProgressAtiva(tipoMesa,2);
			});

		}

		function irPasso(passo) {
			$('.passo.ativo').removeClass('ativo').addClass('escondido');
			$('#pz-passo-'+passo).removeClass('escondido').addClass('ativo');
			$('#progress li').removeClass('active');
			$('#progress li:eq('+(passo-1)+')').addClass('active');

			$('#tbl-mesas a img').remove();
			$('#pz-txt-mesa').val('');
			$('#dv-controles button').attr("disabled","disabled");

			if(passo==1) {
				removeValoresReserva();
				$('#pz-txt-data').val('');
				$('#pz-txt-tipo-mesa').val('');
				$('#pz-txt-mesa-horario').val('');

			} else if(passo==2) {
				removeValoresReserva();
				$('#pz-txt-tipo-mesa').val('');
				$('#pz-txt-mesa-horario').val('');
			}

			
			var progs = $('#progress li');
			for(i=progs.length;i>=passo-1;i--) {
				$(progs[i]).find('em').remove();
			}

		}

		function escreveProgressAtiva(valor, passo) {
			$('#progress .active').html($('#progress .active').html()+'<em> ('+valor+') <a href="javascript:irPasso('+passo+');">alterar</a><em>');
			progressNext();
		}

		function progressNext() {
			$('#progress .active').removeClass('active').next().addClass('active');
			$('.passo.ativo').removeClass('ativo').addClass('escondido').next().removeClass('escondido').addClass('ativo');
		}