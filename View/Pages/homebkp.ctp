	
	<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
	<script src="js/jMonthCalendar.js" type="text/javascript"></script>
	<script src="js/jquery.fullPage.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				sectionsColor: ['#0787ff', '#ffa734', '#07d9ff', '#07ffb0','#49585f' ,'#c3eb24', '#fff'],
				anchors: ['inicial', 'acasa', 'servicos', 'agendaesports', 'playerzone', 'localizacao', 'contato'],
				css3:false,
				menu: '#menu',
				onLeave: function(index, nextIndex, direction){
					console.log('on leave');
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
			
		});
		
		        $().ready(function() {
									
			
			var options = {
				containerId: "#jCalMesAtual",
				calendarStartDate:new Date()
			};
			$.jMonthCalendar.Initialize(options);
			
			data = new Date();
			var dt = new Date(data.getFullYear(),data.getMonth()+1,1,1,1,1);
			var options = {
				containerId: "#jCalProxMes",
				calendarStartDate:dt
			};
			$.jMonthCalendar.Initialize(options);

        });
		
		$().ready(function time() {
			var meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
			var dias = ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sabado'];
			var today = new Date();
			var d = today.getDate();
			var dia = today.getDay();
			var m = today.getMonth();
			var a = today.getFullYear();
			$('#semanahoje').html('Hoje é <br />' + dias[dia]);
			$('#diahoje').html(+ d);
			$('#meshoje').html('de '+meses[m]);
			$('#anohoje').html(+ a +'<br /> Reserve já seu horário ;)');
			
		});

	</script>

	<div class="container">
		
		<nav id="menu"><!-- id="bt-menu" class="bt-menu"-->
			<a href="javascript:void(0)" class="bt-menu-trigger"><span>Menu</span></a>
			<ul>
				<li><a href="#inicial"><img src="/img/houz2.png"></a></li>
				<li><a href="#acasa">A Casa</a></li>
				<li><a href="#servicos">Serviços</a></li>
				<li><a href="#agendaesports">Agenda E-Sports</a></li>
				<li><a href="#playerzone">Player Zone</a></li>
				<li><a href="#localizacao">Localização</a></li>
				<li><a href="#contato">Contato</a></li>
			</ul>
		</nav>
		
	</div><!-- /container -->
	
	<div id="fullpage" class="fullpage">
		
		<div class="section " id="inicialx">
			<iframe src="http://player.twitch.tv/?channel=geekhouz" frameborder="0" scrolling="no" height="378" width="620"></iframe>
			<a href="http://www.twitch.tv/geekhouz?tt_medium=live_embed&tt_content=text_link" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline;">
			</a>
				<!-- <h1><img src="/img/ghlogo.png" alt="Logo Gamming House"></h1> -->
		</div>
		
		<div class="section "id="acasax">
			<span class="acasa">Somos a segunda casa dos adoradores de nerdisses! Uma casa onde você pode aproveitar, junto com os amigos, da maneira mais completa o mundo nerd-geek, contemplando diversos segmentos desse maravilhoso universo.
			
			<p>Venha conhecer nossa casa, traga seus amigos para uma partida de league of legends transmitida ao vivo via stream, venha assistir a campeonatos da e-sports, jogar um game de galera seja eletrônico ou de tabuleiro. Mestrar aquela aventura de RPG para seus heróis em um ambiente propicio, ou aquele cardgame que nós adoramos. Tudo isso em casa! Sentiu fome? Bateu aquela sede? Vá na cozinha, abra o freezer e prepare uma pizza com a bebida que desejar.
			</span>
		</div>
		
		<div class="section " id="servicosx">
			<span class="servicos">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris maximus non elit at varius. Aenean eu tincidunt eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras pulvinar varius dictum. Proin ante neque, auctor sed ornare ut, pharetra vulputate odio. Proin mi justo, eleifend quis nunc eget, tincidunt tristique nisi. Donec gravida nisi a ex congue, a faucibus magna porttitor. Vestibulum a nibh quis arcu suscipit tincidunt. Curabitur quis nisi ac dui finibus imperdiet sit amet in massa.

			<p>Nulla molestie convallis mi, a imperdiet turpis imperdiet nec. Cras a molestie ante. Maecenas in eleifend mi. Donec bibendum est euismod massa scelerisque, ut fermentum dui consectetur. Vivamus commodo velit non auctor porta. Integer nec egestas ligula, et commodo est. Aliquam eget lobortis nibh. Proin aliquet enim non luctus condimentum. Praesent pellentesque pharetra rhoncus.

			</span>
		</div>
		
		<div class="section " id="agendaesportsx">
			<span class="agendaesports">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris maximus non elit at varius. Aenean eu tincidunt eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras pulvinar varius dictum. Proin ante neque, auctor sed ornare ut, pharetra vulputate odio. Proin mi justo, eleifend quis nunc eget, tincidunt tristique nisi. Donec gravida nisi a ex congue, a faucibus magna porttitor. Vestibulum a nibh quis arcu suscipit tincidunt. Curabitur quis nisi ac dui finibus imperdiet sit amet in massa.

			<p>Nulla molestie convallis mi, a imperdiet turpis imperdiet nec. Cras a molestie ante. Maecenas in eleifend mi. Donec bibendum est euismod massa scelerisque, ut fermentum dui consectetur. Vivamus commodo velit non auctor porta. Integer nec egestas ligula, et commodo est. Aliquam eget lobortis nibh. Proin aliquet enim non luctus condimentum. Praesent pellentesque pharetra rhoncus.

			</span>
		</div>
		
		<div class="section " id="playerzonex">
			<span class="playerzone">
				<div id="hoje" class="hoje">
					<span id="semanahoje" class="semanahoje"></span> <hr>
					<span id="diahoje" class="diahoje"> </span> <hr>
					<span id="meshoje" class="meshoje"> </span>
					<span id="anohoje" class="anohoje"> </span>
				</div>
			<div id="jCalMesAtual" class="jCalMesAtual"></div>
			<div id="jCalProxMes" class="jCalProxMes"></div>
			</span>
		</div>
				
		<div class="section " id="localizacaox">
			<span class="localizacao">
				<div class="slide" data-anchor="slide1"> Slide 1 </div>
				<div class="slide" data-anchor="slide2"> Slide 2 </div>
				<div class="slide" data-anchor="slide3"> Slide 3 </div>
				<div class="slide" data-anchor="slide4"> Slide 4 </div>
			</span>
		</div>
		
		<div class="section " id="contatox">
			<span class="contato">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris maximus non elit at varius. Aenean eu tincidunt eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras pulvinar varius dictum. Proin ante neque, auctor sed ornare ut, pharetra vulputate odio. Proin mi justo, eleifend quis nunc eget, tincidunt tristique nisi. Donec gravida nisi a ex congue, a faucibus magna porttitor. Vestibulum a nibh quis arcu suscipit tincidunt. Curabitur quis nisi ac dui finibus imperdiet sit amet in massa.

			<p>Nulla molestie convallis mi, a imperdiet turpis imperdiet nec. Cras a molestie ante. Maecenas in eleifend mi. Donec bibendum est euismod massa scelerisque, ut fermentum dui consectetur. Vivamus commodo velit non auctor porta. Integer nec egestas ligula, et commodo est. Aliquam eget lobortis nibh. Proin aliquet enim non luctus condimentum. Praesent pellentesque pharetra rhoncus.

			</span>
		</div>		
	</div>
	
	<div id="controles-sociais">
		<a href="https://twitter.com/GeekHouz"  target="_blank"><img src="/img/twitter1.png" onMouseOver="this.src='/img/twitter2.png'" onMouseOut="this.src='/img/twitter1.png'" ></a>
		<a href="https://www.facebook.com/geekhouz"  target="_blank"><img src="/img/facebook1.png" onMouseOver="this.src='/img/facebook2.png'" onMouseOut="this.src='/img/facebook1.png'"></a>
		<a href="#self"><img src="/img/instagram1.png" onMouseOver="this.src='/img/instagram2.png'" onMouseOut="this.src='/img/instagram1.png'"></a>
		<a href="#self"><img src="/img/youtube1.png" onMouseOver="this.src='/img/youtube2.png'" onMouseOut="this.src='/img/youtube1.png'"></a>
		<a href="#self"><img src="/img/snapchat1.png" onMouseOver="this.src='/img/snapchat2.png'" onMouseOut="this.src='/img/snapchat1.png'"></a>
	</div>
