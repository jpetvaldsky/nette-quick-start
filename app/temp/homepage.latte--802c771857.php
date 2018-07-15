<?php
// source: latte/homepage.latte

use Latte\Runtime as LR;

class Template802c771857 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '@layout.latte';
		
	}


	function blockContent($_args)
	{
?><div class="maskShape shapeTop"></div>
        <div class="positionFilter">
            <h1>K nám chodí lidé proto,<br>že je u nás práce baví.</h1>
            <form>
                <h3 class="textCenter">PŘIDEJTE SE K NÁM DO</h3>
                <div class="selectGroup">
                    <div class="selectBox selectCategory">
                        <select name="category" id="filterCategory"  data-placeholder="Vyberte obor" placeholder="Vyberte obor" class="select2 jobFilter" multiple="multiple">
                            <optgroup label="Vyberte obor">
                                <option value="Administrativní podpory">Administrativní podpory</option>
                                <option value="Finančních služeb">Finančních služeb</option>
                                <option value="IT">IT</option>
                                <option value="Klientské podpory">Klientské podpory</option>
                                <option value="Legislativy">Legislativy</option>
                                <option value="Metodiky">Metodiky</option>
                                <option value="Práci v terénu">Práci v terénu</option>
                                <option value="Jiná pozice">Jiná pozice</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="selectBox selectLocation">
                        <select name="location" id="filterLocation" data-placeholder="Vyberte kraj" placeholder="Vyberte kraj" class="select2 jobFilter" multiple="multiple">
                            <optgroup label="Vyberte kraj">
                                <option value="Praha">v Hlavním městě Praha</option>
                                <option value="Středočeský kraj">ve Středočeském kraji</option>
                                <option value="Jihočeský kraj">v Jihočeském kraji</option>
                                <option value="Plzeňský kraj">v Plzeňském kraji</option>
                                <option value="Karlovarský kraj">v Karlovarském kraji</option>
                                <option value="Ústecký kraj">v Ústeckém kraji</option>
                                <option value="Liberecký kraj">v Libereckém kraji</option>
                                <option value="Královéhradecký kraj">v Královéhradeckém kraji</option>
                                <option value="Pardubický kraj">v Pardubickém kraji</option>
                                <option value="Vysočina">v kraji Vysočina</option>
                                <option value="Jihomoravský kraj">v Jihomoravském kraji</option>
                                <option value="Olomoucký kraj">v Olomouckém kraji</option>
                                <option value="Zlínský kraj">ve Zlínském kraji</option>
                                <option value="Moravskoslezský kraj">v Moravskoslezském kraji</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="textCenter aScroll">
                    <a href="#volna-mista" type="submit" id="positionResult" class="button btn-large">ZOBRAZIT <span class="counter">0</span> volných pozic</a>
                    <div id="noJobResult" class="watchDogInfo hidden">
                            <p>V tuto chvílí nemáme žadnou volnou pozici.<br>Zanechte nám svůj email a my vám dáme vědět až se něco objeví.</p>
                            <a href="#hlidaci-pes">Zanechat email</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="wrapper">
            <div class="wrapperBackground">
                <div class="content">
                    <div id="volna-mista" class="contentBlock positions">
                        <h2>VYBERTE POZICI, KTERÁ VÁS NEJVÍCE ZAJÍMÁ</h2>
                        <table>                            
                            <thead>
                                <tr>
                                    <th>POZICE</th>
                                    <th>LOKALITA</th>
                                    <th class="date">ZAČÁTEK PODÁNÍ PŘIHLÁŠEK</th>
                                    <th class="date">KONEC PODÁNÍ PŘIHLÁŠEK</th>
                                </tr>
                            </thead>
                            <tbody class="filterPositionResult">
                                <tr>
                                    <td class="positionLink"><a href="position-popup.html">Referent Oddělení příjmu žádostí a LPIS</a></td>
                                    <td class="location"><span>Olomouc</span></td>
                                    <td class="date">1.2.2018</td>
                                    <td class="date deadline">1.2.2018</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="hlidaci-pes" class="contentBlock positions hidden">
                        <h2>ZADEJTE Váš email A MY SE VÁM OZVEME</h2>
                        <form class="form watchDog">
                            <input type="text" placeholder="@">
                            <div class="notifySelection">
                                <h4>Máte nastaveno hlídání těchto parametrů:</h4>
                                <div class="selectedCategories">
                                    <strong>OBOR:</strong>
                                    <div class="selectedItems empty">
                                        -- vyberte prosím obor(y) z nabídky nahoře --                                        
                                    </div>
                                </div>
                                <div class="selectedLocations">
                                    <strong>KRAJ:</strong>
                                    <div class="selectedItems empty">-- vyberte prosím kraj(e) z nabídky nahoře --</div>
                                </div>
                            </div>
                            <div class="textCenter">
                                <button type="submit" class="button btn-outline">Odeslat</button>
                            </div>
                        </form>
                        <div class="thankYou hidden">Děkujeme za Váš zájem, vaše volba byla uložena.</div>
                    </div>
                    <div id="nas-hr-tym" class="contentBlock hrTeam">
                        
                        <h2>S KÝM SE MŮŽETE POTKAT U POHOVORU</h2>

                        <div class="slider-pro peopleHR" id="hr-team">
                            <div class="sp-slides">
                                <!-- HR 1 -->
                                <div class="sp-slide hr-person">
                                    <div class="inner">
                                        <div class="hr-person-image">
                                            <img src="/assets/img/hr-team/jana-novakova.png" alt="">
                                        </div>
                                        <h3>Ing. Jana Nováková</h3>
                                        <h4>Head of HR / Hlavní město Praha</h4>
                                        <p class="hr-about">“Ve SZIF pracuji již 5 let na pozici Head of HR a mám na starost nábor pro hlavní město Praha.<br>Ve svém volném čase se věnuji křížovkám, vnoučatum a jízdě na kole.”</p>
                                        <strong>Můj tip pro Vás</strong>
                                        <p>“Nebojte se být sama sebou u pohovoru, i bez praxe se můžete uchytit.<br>Důležité je se nás nebát a usmívat se.”</p>
                                        <div class="textCenter">
                                                <a href="#" class="button btn-outline">Kontaktovat</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- HR 2 -->
                                <div class="sp-slide hr-person">
                                    <div class="inner">
                                        <div class="hr-person-image">
                                            <img src="/assets/img/hr-team/frantisek-koukolik.png" alt="">
                                        </div>
                                        <h3>Mgr. František Novotný</h3>
                                        <h4>Head of IT / Hlavní město Praha</h4>
                                        <p class="hr-about">“Pracuji jako koordinátor a mám na starost dotace pro rybáře. Vybral jsem si tento obor, protože sám jsem velmi vášnivý rybář a když uspějete u pohovoru tak Vám prozradím kde nejvíce berou.” </p>
                                        

                                        <strong>Můj tip pro Vás</strong>
                                        <p>“Osobně ocěnuji transparentnost u pohovoru, pokud něco neumíte tak to přiznejte a třeba zjistíme, že se to půjde v pohodě doučit.”</p>
                                        <div class="textCenter">
                                                <a href="#" class="button btn-outline">Kontaktovat</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- HR 3 -->
                                <div class="sp-slide hr-person">
                                    <div class="inner">
                                        <div class="hr-person-image">
                                            <img src="/assets/img/hr-team/jana-novakova.png" alt="">
                                        </div>
                                        <h3>Bc. Karolína Větrová</h3>
                                        <h4>Marketing Director / Hlavní město Praha</h4>
                                        <p class="hr-about">“Ve SZIF pracuji již 5 let na pozici Head of HR a mám na starost nábor pro hlavní město Praha.<br>Ve svém volném čase se věnuji křížovkám, vnoučatum a jízdě na kole.”</p>
                                        <strong>Můj tip pro Vás</strong>
                                        <p>“Nebojte se být sama sebou u pohovoru, i bez praxe se můžete uchytit.<br>Důležité je se nás nebát a usmívat se.”</p>
                                        <div class="textCenter">
                                                <a href="#" class="button btn-outline">Kontaktovat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.hrTeam .contentBlock -->
                    
                    <div id="novinky" class="contentBlock news">
                        <h2>Co nového u nás</h2>
                        <div class="clearfix">
                            <div class="news-article">
                                <a href="#" class="news-header">
                                    <img src="/assets/img/news/n01.jpg" alt="SZIF přivítá jaro na výstavě Zemědělec 2018">
                                    <span class="date">20.3.2018</span>
                                </a>
                                <a href="#" class="news-headline">SZIF přivítá jaro na výstavě Zemědělec 2018</a>
                                <div class="news-perex">Zítra začíná v Lysé nad Labem celostátní výstava Zemědělec 2018. Spojit příchod jara s návštěvou této akce je ideální kombinace, pro ty, kteří na svých zahradách a polích netrpělivě vyhlížejí vše, co vykukuje z hlíny.</div>
                            </div>
                            <!-- /.news-article -->

                            <div class="news-article">
                                <a href="#" class="news-header">
                                    <img src="/assets/img/news/n02.jpg" alt="SZIF na veletrhu Salima a Festivalu chutí">
                                    <span class="date">7.3.2018</span>
                                </a>
                                <a href="#" class="news-headline">SZIF na veletrhu Salima a Festivalu chutí</a>
                                <div class="news-perex">Příznivci dobrého jídla a pití by měli zbystřit. 27. února totiž startuje gastronomická přehlídka v podobě mezinárodního potravinářského veletrhu SALIMA.</div>
                            </div>
                            <!-- /.news-article -->

                            <div class="news-article">
                                    <a href="#" class="news-header">
                                        <img src="/assets/img/news/n03.jpg" alt="SZIF na Veletrhu pracovních příležitostí">
                                        <span class="date">21.2.2018</span>
                                    </a>
                                    <a href="#" class="news-headline">SZIF na Veletrhu pracovních příležitostí</a>
                                    <div class="news-perex">Státní zemědělský intervenční fond (SZIF) se veletrhu účastní pravidelně. Letos se zde představí společně s 15 výrobci kvalitních potravin, kteří se mohou u svých výrobků pochlubit značkou Regionální potravina&hellip;</div>
                                </div>
                                <!-- /.news-article -->

                            

                            
                        </div>
                        <div class="textCenter">
                            <a href="#" class="button btn-outline">Načíst starší novinky</a>
                        </div>
                    </div>
                    <!-- /.news .contentBlock -->
                    <div id="caste-dotazy" class="contentBlock faq">
                        <h2>Mohly by Vás zajímat</h2>
                        
                        <div class="faq-article">
                            <a href="#" class="faq-header">Jaké musím mít vzdělání?</a>
                            <div class="faq-answer">
                                <p>Pro téměř 90 % nabízených pozic je potřebný bakalářský nebo magisterský titul. Uplatnění však u nás naleznou i absolventi vyšších odborných škol, nebo středních škol s maturitou.</p>
                                <p>Největší šanci mají absolventi z oborů jako je ekonomie, zemědělství, technika, právo…</p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Mohou se na volná místa hlásit i uchazeči bez praxe?</a>
                            <div class="faq-answer">
                                <p>Ano, rádi uvítáme v našich řadách i čerstvé absolventy bez praxe.</p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Můžu se hlásit na více vypsaných pozic? Za jakých podmínek?</a>
                            <div class="faq-answer">
                                <p>Rozhodně ano!</p>
                                <p>Dejte si jen pozor, pokud se budete hlásit na služební místa do služebního poměru. I když se pozice mohou odlišovat pouze lokalitou, je nutné hlásit se na každou pozici zvlášť. Stejně tak bude i Vás osobní pohovor probíhat před výběrovou komisí pro každou pozici zvlášť.</p>
                                <p>
                                    Jen pro připomenutí – ke každé žádosti musíte přiložit následující dokumenty:<br>
                                    <ul>
                                        <li>Příslušná „žádost o přijetí do služebního poměru a zařazení na služební místo“ včetně všech povinných příloh (jedná se o čestná prohlášení)</li>
                                        <li>Motivační dopis pro příslušnou pozici</li>
                                        <li>Strukturovaný životopis</li>
                                        <li>Výpis z rejstříku trestů. Ten si dokážeme obstarat i sami (stačí vyplnit přílohu „Údaje poskytnuté žadatelem“).</li>
                                    </ul>
                                </p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Opravdu musím doložit všechny požadované dokumenty? Copak nestačí doložit pouze kopie?</a>
                            <div class="faq-answer">
                                <p>U každé žádosti se podívejte do příloh na „Oznámení o vyhlášení VŘ“. Tam naleznete přesné podmínky podání žádosti, včetně informace, zda potřebujete doložit originály dokumentů nebo jen kopie.</p>
                                <p>U většiny žádostí platí:<br>
                                    <ol>
                                        <li>Ve chvíli, kdy podáte žádost na příslušnou pozici je potřeba dodat originál dané žádosti, čestných prohlášení a výpisu z rejstříku trestů. Ostatní dokumenty stačí v kopii.</li>
                                        <li>Na pohovor už ale musíte přinést originál dokladu vašeho nejvyššího vzdělání.</li>
                                    </ol>
                                </p>
                                    
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Jaký je adaptační proces?</a>
                            <div class="faq-answer">
                                <p>Délka adaptačního procesu pro nové zaměstnance je 3 měsíce, u státních zaměstnanců se jedná o 6 měsíců. To poskytuje novému zaměstnanci dostatečný čas na seznámení se všemi vnitřními předpisy, pracovním prostředím, kolegy, benefity a pracovními úkoly. Nemusíte se ale bát, že na to budete sami. Bude k vám přidělen školitel, na kterého se budete moci během adaptačního procesu kdykoliv obrátit.</p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Jaká je pracovní doba?</a>
                            <div class="faq-answer">
                                <p>V SZIF máme pružnou pracovní dobu. Co to znamená? Po uplynutí zkušební doby (a dohodě s vaším nadřízeným) si můžete sami zvolit dobu příchodu a odchodu. Samozřejmě tak, abyste odpracovali 8 hodin a zároveň byli na pracovišti během „základní doby“. Základní doba je časový úsek, během kterého je zaměstnanec povinen být na pracovišti.</p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Jaký je rozdíl mezi služebním a pracovním poměrem?</a>
                            <div class="faq-answer">
                                <p>Služební poměry vznikají pouze na služebních místech, jako je například ministerstvo nebo úřad. To dělá ze zaměstnanců SZIF “státní zaměstnance“.</p>
                                <p>Čím se odlišuje státní zaměstnanec od toho „nestátního“?
                                -	Snadněji sladí rodinný a pracovní život – má nárok např. na placené volno k vyřízení osobních záležitostí, volno k doprovodu dítěte v první den školní docházky (1. třída), aj.
                                -	Při změně místa v rámci státní správy nemusí znovu absolvovat zkušební dobu
                                </p>
                                <p>Mimo to je dobré vědět, že státní zaměstnanec musí složit úřednickou zkoušku (viz. další otázka) a první den v zaměstnání skládá tzv. služební slib.</p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Co je to úřednická zkouška?</a>
                            <div class="faq-answer">
                                <p>Zkoušku budete jako státní zaměstnanci vykonávat přijetí na služební místo ve státní správě. Co vás bude čekat? Zkouška se skládá se dvou částí:<br>
                                Obecná část. Ta je písemná a okruh má 300 otázek. Každý zkoušený dostane 30 otázek, ze kterých musí na 22 odpovědět správně. Můžete se těšit na otázky jako: Jaké jsou státní symboly ČR? Jak je možné zřídit nebo zrušit ministerstvo? Kolik soudců má Ústavní soud? …a stovky dalších.</p>
                                
                                <p>Po splnění první části postupuje úředník do druhé, zvláštní části. Ta probíhá před 3 člennou komisí a jejím úkolem je prověření znalostí potřebných pro příslušný obor státní správy.</p>
                                
                                <p>Pokud se vám státní zkouškou nepodaří projít na poprvé, máte ještě jeden pokus. Pokud se nepodaří ani ten, znamená to ukončení pracovního poměru.</p>
                                
                                <p>Více informaci najdete zde: <a href="http://www.mvcr.cz/sluzba/urednicka-zkouska.aspx" target="_blank">http://www.mvcr.cz/sluzba/urednicka-zkouska.aspx</a></p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Jak je stanoveno finanční ohodnocení zaměstnanců na SZIF?</a>
                            <div class="faq-answer">
                                <p>Výpočet mzdy se skládá z několika částí:<br>
                                    <ol>
                                        <li>Každé místo je podle náročnosti zařazeno do dané platové třídy</li>
                                        <li>Poté se podle předchozí praxe spočítá platový stupeň</li>
                                        <li>Výsledná mzda je tedy dána platovou třídou a platovým stupněm</li>
                                        <li>Bonusem ke mzdě je osobní příplatek, který může dosahovat 10–30 % nejvyššího platového stupně dané platové třídy</li>
                                    </ol>
                                </p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Jak probíhá osobní pohovor?</a>
                            <div class="faq-answer">
                                <p>Bude váš čekat cca půlhodinový pohovor před (tříčlennou) komisí. Cílem je prověření vaší odbornosti, dozvědět se více o vašich předešlých pracovních zkušenostech a v neposlední řadě se zde ukáže vaše motivovanost.</p>
                            </div>
                        </div><!-- /.faq-article -->

                        <div class="faq-article">
                            <a href="#" class="faq-header">Kde budu pracovat?</a>
                            <div class="faq-answer">
                                <p>Vzhledem k působnosti našeho úřadu je velmi reálné, že budete pracovat v blízkosti svého bydliště. U každé pracovní pozice je místo působení přesně popsáno.</p>
                            </div>
                        </div><!-- /.faq-article -->
                        
                        <div class="faq-article">
                            <a href="#" class="faq-header">Co když nenaleznu vhodnou pozici/co když moje v mém kraji není zrovna volné místo?</a>
                            <div class="faq-answer">
                                <p>Nic není ztraceno. Stačí jen vyplnit formulář a nás hlídací pes vám dá vědět, až bude vaše vysněná pozice vypsaná.</p>
                            </div>
                        </div><!-- /.faq-article -->
                    </div>
                    <!-- /.faq .contentBlock -->
                    <div id="co-je-szif" class="contentBlock about">
                        <h2>Kdo jsme a co děláme</h2>
                        
                        <div class="about-article ico-introduction">
                            <h3 class="about-headline">SZIF představení</h3>
                            <div class="about-content">
                                <p>SZIF je zkratka pro Státní zemědělský intervenční fond. Co se pod touto krkolomnou zkratkou skrývá?</p>
                                <p>Jsme jediná akreditované platební agentura v České republice, která má na starost rozdělování zdrojů plynoucích z našich a evropských fondů. Chceme, aby se penězi neplýtvalo a dostaly se tam, kde budou pomáhat. Máme řadu dotačních programů, jejichž cílem je podpora našich chovatelů, včelařů, zemědělců a těch, co obhospodařují naše lesy a rybníky, a tím vším pomáhají rozvíjet venkov a produkují potraviny té nejvyšší kvality.</p>
                            </div>
                        </div><!-- /.about-article -->

                        <div class="about-article ico-agro">
                            <h3 class="about-headline">Jak konkrétně pomáháme českému zemědělství?</h3>
                            <div class="about-content">
                                <p>Naši pomoc cílíme na malé a střední zemědělce. Snažíme se, aby práce v zemědělství byla cool i pro mladé a dáváme jim šanci ukázat co v nich je. Podporujeme značky Klasa a Regionální potravina – obě dvě vám dávají záruku, že jíte skutečně kvalitní potravinu a zároveň podpoříte lokální producenty. Ti pak mohou rozšířit své podnikaní, investovat do nového vybavení a zároveň zaměstnávat více lidí. (V oblastech s vysokou nezaměstnaností je toto životně důležité.) A to nám dělá radost.</p>
                            </div>
                        </div><!-- /.about-article -->
                        
                        <div class="about-article ico-winner">
                            <h3 class="about-headline">Na co jsme pyšní?</h3>
                            <div class="about-content">
                                <p>Jsme skvělí v tom, že se nám daří čerpat všechny alokované prostředky a tím se může pochlubit opravdu málokterý úřad. Dokážeme poradit a provést žadatele celým procesem tak, aby byl pro něj co nejjednodušší a časově nenáročný. A tak se k nám naši klienti rádi vrací, protože vědí, že jsme tu pro ně.</p>
                            </div>
                        </div><!-- /.about-article -->

                        <div class="about-article ico-computer">
                            <h3 class="about-headline">Jak se u nás pracuje?</h3>
                            <div class="about-content">
                                <p>Libí se nám práce pro SZIF? To si pište! Udělali jsme si mezi sebou menší průzkum a vyšlo nám, že SZIF vidíme jako přátelský, otevřený, nápomocný, stabilní a užitečný. Místo, kde dostanou šanci studenti po škole, a kde je samozřejmě šance uplatnit dosavadní zkušenosti. Zároveň nás hřeje pocit, že díky naší práci se zlepšil život mnoha lidí.</p>
                            </div>
                        </div><!-- /.about-article -->
                        <div class="textCenter scrollTop">
                            <a href="#top" class="button btn-outline about-cta">Pojďte spolu s námi pomáhat českému zemědělství!</a>                            
                        </div>
                    </div>
                    <!-- /.about .contentBlock -->
                </div>                
            </div>
            <div class="maskShape shapeBottom"></div>
        </div>

<?php
	}

}
