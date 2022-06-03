// nav toggler
const menuBtn = document.querySelector('.menuBTN');
const navContainer = document.querySelector('.navigation');
let menuOpen = false;
menuBtn.addEventListener('click', () => {
  if (!menuOpen) {
    menuBtn.classList.add('open');
    menuOpen = true;
    navContainer.classList.add('show');
  } else {
    menuBtn.classList.remove('open');
    menuOpen = false;
    navContainer.classList.remove('show');
  }
});

var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
  $BODY = $('body'),
  $SIDEBAR_MENU = $('.Sidebar'),
  // $NAV_MENU = $('.nav_menu'),
  // Sidebar

  openUpMenu = function () {
    $SIDEBAR_MENU.find('li ul').slideUp();
  };

$SIDEBAR_MENU.find('a').on('click', function (ev) {
  console.log('clicked');
  // check if exist dropdown then slidup that thing and remove active class
  var $li = $(this).parent();
  if ($('ul:first', $li).is(':visible')) {
    $li.removeClass('current-page');
    $('ul:first', $li).slideUp();
  } else {
    $li.children('a').addClass('current-page');
    $('ul:first', $li).slideDown();
  }
});

// check active menu
$SIDEBAR_MENU
  .find('a[href="' + CURRENT_URL + '"]')
  .parent('li')
  .addClass('current-page');

$SIDEBAR_MENU
  .find('a')
  .filter(function () {
    return this.href == CURRENT_URL;
  })
  .parent('li')
  // .addClass('link_active')
  .parents('ul')
  .slideDown()
  .siblings()
  .addClass('current-page');

// search toggler

const searchToggle = document.querySelector('.searchToggle');
const inputBox = document.querySelector('.header_search');
searchToggle.addEventListener('click', () => {
  if (inputBox.classList.contains('search_show') && inputBox.value === '') {
    inputBox.classList.remove('search_show');
  } else {
    inputBox.classList.add('search_show');
    setTimeout(() => {
      document.querySelector('.header_search').focus();
    }, 500);
  }
});

inputBox.addEventListener('blur', () => {
  if (inputBox.value == '') inputBox.classList.remove('search_show');
});

var DeviceWidth = window.matchMedia('(max-width: 599px)');
const SearchContainer = document.querySelector('.searchbar');
if (DeviceWidth.matches) {
  searchToggle.addEventListener('click', () => {
    menuBtn.style.display = 'none';
    inputBox.classList.add('search_show');
    setTimeout(() => {
      document.querySelector('.header_search').focus();
    }, 18);
    SearchContainer.classList.add('search-expanded');
  });
  inputBox.addEventListener('focus', () => {
    menuBtn.style.display = 'none';
    SearchContainer.classList.add('search-expanded');
  });
  inputBox.addEventListener('blur', () => {
    if (inputBox.value === '') {
      menuBtn.style.display = 'flex';
      inputBox.classList.remove('search_show');
      SearchContainer.classList.remove('search-expanded');
      SearchContainer.removeAttribute('style');
    } else {
      menuBtn.style.display = 'flex';
      SearchContainer.classList.remove('search-expanded');
      SearchContainer.style.minWidth = '30%';
    }
  });
}

$('.owl-carousel').owlCarousel({
  items: 1,
  nav: true,
  dots: true,
  navText: [
    "<img src='"+window.location.origin+"/wp-content/themes/massy_group/assets/images/prevBtn.png'>",
    "<img src='"+window.location.origin+"/wp-content/themes/massy_group/assets/images/nextBtn.png'>",
  ],
});

$('.owl-carousel').on('changed.owl.carousel', function (event) {
  var item = event.item.index - 2; // Position of the current item
  $('.bottomBox').removeClass('animateIn');
  $('.owl-item')
    .not('.cloned')
    .eq(item)
    .find('.bottomBox')
    .addClass('animateIn');
});

// chart js
// data = [
//   [1529328600000, 188.74],
//   [1529415000000, 185.69],
//   [1529501400000, 186.5],
//   [1529587800000, 185.46],
//   [1529674200000, 184.92],
//   [1529933400000, 182.17],
//   [1530019800000, 184.43],
//   [1530106200000, 184.16],
//   [1530192600000, 185.5],
//   [1530279000000, 185.11],
//   [1530538200000, 187.18],
//   [1530624600000, 183.92],
//   [1530797400000, 185.4],
//   [1530883800000, 187.97],
//   [1531143000000, 190.58],
//   [1531229400000, 190.35],
//   [1531315800000, 187.88],
//   [1531402200000, 191.03],
//   [1531488600000, 191.33],
//   [1531747800000, 190.91],
//   [1531834200000, 191.45],
//   [1531920600000, 190.4],
//   [1532007000000, 191.88],
//   [1532093400000, 191.44],
//   [1532352600000, 191.61],
//   [1532439000000, 193],
//   [1532525400000, 194.82],
//   [1532611800000, 194.21],
//   [1532698200000, 190.98],
//   [1532957400000, 189.91],
//   [1533043800000, 190.29],
//   [1533130200000, 201.5],
//   [1533216600000, 207.39],
//   [1533303000000, 207.99],
//   [1533562200000, 209.07],
//   [1533648600000, 207.11],
//   [1533735000000, 207.25],
//   [1533821400000, 208.88],
//   [1533907800000, 207.53],
//   [1534167000000, 208.87],
//   [1534253400000, 209.75],
//   [1534339800000, 210.24],
//   [1534426200000, 213.32],
//   [1534512600000, 217.58],
//   [1534771800000, 215.46],
//   [1534858200000, 215.04],
//   [1534944600000, 215.05],
//   [1535031000000, 215.49],
//   [1535117400000, 216.16],
//   [1535376600000, 217.94],
//   [1535463000000, 219.7],
//   [1535549400000, 222.98],
//   [1535635800000, 225.03],
//   [1535722200000, 227.63],
//   [1536067800000, 228.36],
//   [1536154200000, 226.87],
//   [1536240600000, 223.1],
//   [1536327000000, 221.3],
//   [1536586200000, 218.33],
//   [1536672600000, 223.85],
//   [1536759000000, 221.07],
//   [1536845400000, 226.41],
//   [1536931800000, 223.84],
//   [1537191000000, 217.88],
//   [1537277400000, 218.24],
//   [1537363800000, 218.37],
//   [1537450200000, 220.03],
//   [1537536600000, 217.66],
//   [1537795800000, 220.79],
//   [1537882200000, 222.19],
//   [1537968600000, 220.42],
//   [1538055000000, 224.95],
//   [1538141400000, 225.74],
//   [1538400600000, 227.26],
//   [1538487000000, 229.28],
//   [1538573400000, 232.07],
//   [1538659800000, 227.99],
//   [1538746200000, 224.29],
//   [1539005400000, 223.77],
//   [1539091800000, 226.87],
//   [1539178200000, 216.36],
//   [1539264600000, 214.45],
//   [1539351000000, 222.11],
//   [1539610200000, 217.36],
//   [1539696600000, 222.15],
//   [1539783000000, 221.19],
//   [1539869400000, 216.02],
//   [1539955800000, 219.31],
//   [1540215000000, 220.65],
//   [1540301400000, 222.73],
//   [1540387800000, 215.09],
//   [1540474200000, 219.8],
//   [1540560600000, 216.3],
//   [1540819800000, 212.24],
//   [1540906200000, 213.3],
//   [1540992600000, 218.86],
//   [1541079000000, 222.22],
//   [1541165400000, 207.48],
//   [1541428200000, 201.59],
//   [1541514600000, 203.77],
//   [1541601000000, 209.95],
//   [1541687400000, 208.49],
//   [1541773800000, 204.47],
//   [1542033000000, 194.17],
//   [1542119400000, 192.23],
//   [1542205800000, 186.8],
//   [1542292200000, 191.41],
//   [1542378600000, 193.53],
//   [1542637800000, 185.86],
//   [1542724200000, 176.98],
//   [1542810600000, 176.78],
//   [1542983400000, 172.29],
//   [1543242600000, 174.62],
//   [1543329000000, 174.24],
//   [1543415400000, 180.94],
//   [1543501800000, 179.55],
//   [1543588200000, 178.58],
//   [1543847400000, 184.82],
//   [1543933800000, 176.69],
//   [1544106600000, 174.72],
//   [1544193000000, 168.49],
//   [1544452200000, 169.6],
//   [1544538600000, 168.63],
//   [1544625000000, 169.1],
//   [1544711400000, 170.95],
//   [1544797800000, 165.48],
//   [1545057000000, 163.94],
//   [1545143400000, 166.07],
//   [1545229800000, 160.89],
//   [1545316200000, 156.83],
//   [1545402600000, 150.73],
//   [1545661800000, 146.83],
//   [1545834600000, 157.17],
//   [1545921000000, 156.15],
//   [1546007400000, 156.23],
//   [1546266600000, 157.74],
//   [1546439400000, 157.92],
//   [1546525800000, 142.19],
//   [1546612200000, 148.26],
//   [1546871400000, 147.93],
//   [1546957800000, 150.75],
//   [1547044200000, 153.31],
//   [1547130600000, 153.8],
//   [1547217000000, 152.29],
//   [1547476200000, 150],
//   [1547562600000, 153.07],
//   [1547649000000, 154.94],
//   [1547735400000, 155.86],
//   [1547821800000, 156.82],
//   [1548167400000, 153.3],
//   [1548253800000, 153.92],
//   [1548340200000, 152.7],
//   [1548426600000, 157.76],
//   [1548685800000, 156.3],
//   [1548772200000, 154.68],
//   [1548858600000, 165.25],
//   [1548945000000, 166.44],
//   [1549031400000, 166.52],
//   [1549290600000, 171.25],
//   [1549377000000, 174.18],
//   [1549463400000, 174.24],
//   [1549549800000, 170.94],
//   [1549636200000, 170.41],
//   [1549895400000, 169.43],
//   [1549981800000, 170.89],
//   [1550068200000, 170.18],
//   [1550154600000, 170.8],
//   [1550241000000, 170.42],
//   [1550586600000, 170.93],
//   [1550673000000, 172.03],
//   [1550759400000, 171.06],
//   [1550845800000, 172.97],
//   [1551105000000, 174.23],
//   [1551191400000, 174.33],
//   [1551277800000, 174.87],
//   [1551364200000, 173.15],
//   [1551450600000, 174.97],
//   [1551709800000, 175.85],
//   [1551796200000, 175.53],
//   [1551882600000, 174.52],
//   [1551969000000, 172.5],
//   [1552055400000, 172.91],
//   [1552311000000, 178.9],
//   [1552397400000, 180.91],
//   [1552483800000, 181.71],
//   [1552570200000, 183.73],
//   [1552656600000, 186.12],
//   [1552915800000, 188.02],
//   [1553002200000, 186.53],
//   [1553088600000, 188.16],
//   [1553175000000, 195.09],
//   [1553261400000, 191.05],
//   [1553520600000, 188.74],
//   [1553607000000, 186.79],
//   [1553693400000, 188.47],
//   [1553779800000, 188.72],
//   [1553866200000, 189.95],
//   [1554125400000, 191.24],
//   [1554211800000, 194.02],
//   [1554298200000, 195.35],
//   [1554384600000, 195.69],
//   [1554471000000, 197],
//   [1554730200000, 200.1],
//   [1554816600000, 199.5],
//   [1554903000000, 200.62],
//   [1554989400000, 198.95],
//   [1555075800000, 198.87],
//   [1555335000000, 199.23],
//   [1555421400000, 199.25],
//   [1555507800000, 203.13],
//   [1555594200000, 203.86],
//   [1555939800000, 204.53],
//   [1556026200000, 207.48],
//   [1556112600000, 207.16],
//   [1556199000000, 205.28],
//   [1556285400000, 204.3],
//   [1556544600000, 204.61],
//   [1556631000000, 200.67],
//   [1556717400000, 210.52],
//   [1556803800000, 209.15],
//   [1556890200000, 211.75],
//   [1557149400000, 208.48],
//   [1557235800000, 202.86],
//   [1557322200000, 202.9],
//   [1557408600000, 200.72],
//   [1557495000000, 197.18],
//   [1557754200000, 185.72],
//   [1557840600000, 188.66],
//   [1557927000000, 190.92],
//   [1558013400000, 190.08],
//   [1558099800000, 189],
//   [1558359000000, 183.09],
//   [1558445400000, 186.6],
//   [1558531800000, 182.78],
//   [1558618200000, 179.66],
//   [1558704600000, 178.97],
//   [1559050200000, 178.23],
//   [1559136600000, 177.38],
//   [1559223000000, 178.3],
//   [1559309400000, 175.07],
//   [1559568600000, 173.3],
//   [1559655000000, 179.64],
//   [1559741400000, 182.54],
//   [1559827800000, 185.22],
//   [1559914200000, 190.15],
//   [1560173400000, 192.58],
//   [1560259800000, 194.81],
//   [1560346200000, 194.19],
//   [1560432600000, 194.15],
//   [1560519000000, 192.74],
//   [1560778200000, 193.89],
//   [1560864600000, 198.45],
//   [1560951000000, 197.87],
//   [1561037400000, 199.46],
//   [1561123800000, 198.78],
//   [1561383000000, 198.58],
//   [1561469400000, 195.57],
//   [1561555800000, 199.8],
//   [1561642200000, 199.74],
//   [1561728600000, 197.92],
//   [1561987800000, 201.55],
//   [1562074200000, 202.73],
//   [1562160600000, 204.41],
//   [1562333400000, 204.23],
//   [1562592600000, 200.02],
//   [1562679000000, 201.24],
//   [1562765400000, 203.23],
//   [1562851800000, 201.75],
//   [1562938200000, 203.3],
//   [1563197400000, 205.21],
//   [1563283800000, 204.5],
//   [1563370200000, 203.35],
//   [1563456600000, 205.66],
//   [1563543000000, 202.59],
//   [1563802200000, 207.22],
//   [1563888600000, 208.84],
//   [1563975000000, 208.67],
//   [1564061400000, 207.02],
//   [1564147800000, 207.74],
//   [1564407000000, 209.68],
//   [1564493400000, 208.78],
//   [1564579800000, 213.04],
//   [1564666200000, 208.43],
//   [1564752600000, 204.02],
//   [1565011800000, 193.34],
//   [1565098200000, 197],
//   [1565184600000, 199.04],
//   [1565271000000, 203.43],
//   [1565357400000, 200.99],
//   [1565616600000, 200.48],
//   [1565703000000, 208.97],
//   [1565789400000, 202.75],
//   [1565875800000, 201.74],
//   [1565962200000, 206.5],
//   [1566221400000, 210.35],
//   [1566307800000, 210.36],
//   [1566394200000, 212.64],
//   [1566480600000, 212.46],
//   [1566567000000, 202.64],
//   [1566826200000, 206.49],
//   [1566912600000, 204.16],
//   [1566999000000, 205.53],
//   [1567085400000, 209.01],
//   [1567171800000, 208.74],
//   [1567517400000, 205.7],
//   [1567603800000, 209.19],
//   [1567690200000, 213.28],
//   [1567776600000, 213.26],
//   [1568035800000, 214.17],
//   [1568122200000, 216.7],
//   [1568208600000, 223.59],
//   [1568295000000, 223.09],
//   [1568381400000, 218.75],
//   [1568640600000, 219.9],
//   [1568727000000, 220.7],
//   [1568813400000, 222.77],
//   [1568899800000, 220.96],
//   [1568986200000, 217.73],
//   [1569245400000, 218.72],
//   [1569331800000, 217.68],
//   [1569418200000, 221.03],
//   [1569504600000, 219.89],
//   [1569591000000, 218.82],
//   [1569850200000, 223.97],
//   [1569936600000, 224.59],
//   [1570023000000, 218.96],
//   [1570109400000, 220.82],
//   [1570195800000, 227.01],
//   [1570455000000, 227.06],
//   [1570541400000, 224.4],
//   [1570627800000, 227.03],
//   [1570714200000, 230.09],
//   [1570800600000, 236.21],
//   [1571059800000, 235.87],
//   [1571146200000, 235.32],
//   [1571232600000, 234.37],
//   [1571319000000, 235.28],
//   [1571405400000, 236.41],
//   [1571664600000, 240.51],
//   [1571751000000, 239.96],
//   [1571837400000, 243.18],
//   [1571923800000, 243.58],
//   [1572010200000, 246.58],
//   [1572269400000, 249.05],
//   [1572355800000, 243.29],
//   [1572442200000, 243.26],
//   [1572528600000, 248.76],
//   [1572615000000, 255.82],
//   [1572877800000, 257.5],
//   [1572964200000, 257.13],
//   [1573050600000, 257.24],
//   [1573137000000, 259.43],
//   [1573223400000, 260.14],
//   [1573482600000, 262.2],
//   [1573569000000, 261.96],
//   [1573655400000, 264.47],
//   [1573741800000, 262.64],
//   [1573828200000, 265.76],
//   [1574087400000, 267.1],
//   [1574173800000, 266.29],
//   [1574260200000, 263.19],
//   [1574346600000, 262.01],
//   [1574433000000, 261.78],
//   [1574692200000, 266.37],
//   [1574778600000, 264.29],
//   [1574865000000, 267.84],
//   [1575037800000, 267.25],
//   [1575297000000, 264.16],
//   [1575383400000, 259.45],
//   [1575469800000, 261.74],
//   [1575556200000, 265.58],
//   [1575642600000, 270.71],
//   [1575901800000, 266.92],
//   [1575988200000, 268.48],
//   [1576074600000, 270.77],
//   [1576161000000, 271.46],
//   [1576247400000, 275.15],
//   [1576506600000, 279.86],
//   [1576593000000, 280.41],
//   [1576679400000, 279.74],
//   [1576765800000, 280.02],
//   [1576852200000, 279.44],
//   [1577111400000, 284],
//   [1577197800000, 284.27],
//   [1577370600000, 289.91],
//   [1577457000000, 289.8],
//   [1577716200000, 291.52],
//   [1577802600000, 293.65],
//   [1577975400000, 300.35],
//   [1578061800000, 297.43],
//   [1578321000000, 299.8],
//   [1578407400000, 298.39],
//   [1578493800000, 303.19],
//   [1578580200000, 309.63],
//   [1578666600000, 310.33],
//   [1578925800000, 316.96],
//   [1579012200000, 312.68],
//   [1579098600000, 311.34],
//   [1579185000000, 315.24],
//   [1579271400000, 318.73],
//   [1579617000000, 316.57],
//   [1579703400000, 317.7],
//   [1579789800000, 319.23],
//   [1579876200000, 318.31],
//   [1580135400000, 308.95],
//   [1580221800000, 317.69],
//   [1580308200000, 324.34],
//   [1580394600000, 323.87],
//   [1580481000000, 309.51],
//   [1580740200000, 308.66],
//   [1580826600000, 318.85],
//   [1580913000000, 321.45],
//   [1580999400000, 325.21],
//   [1581085800000, 320.03],
//   [1581345000000, 321.55],
//   [1581431400000, 319.61],
//   [1581517800000, 327.2],
//   [1581604200000, 324.87],
//   [1581690600000, 324.95],
//   [1582036200000, 319],
//   [1582122600000, 323.62],
//   [1582209000000, 320.3],
//   [1582295400000, 313.05],
//   [1582554600000, 298.18],
//   [1582641000000, 288.08],
//   [1582727400000, 292.65],
//   [1582813800000, 273.52],
//   [1582900200000, 273.36],
//   [1583159400000, 298.81],
//   [1583245800000, 289.32],
//   [1583332200000, 302.74],
//   [1583418600000, 292.92],
//   [1583505000000, 289.03],
//   [1583760600000, 266.17],
//   [1583847000000, 285.34],
//   [1583933400000, 275.43],
//   [1584019800000, 248.23],
//   [1584106200000, 277.97],
//   [1584365400000, 242.21],
//   [1584451800000, 252.86],
//   [1584538200000, 246.67],
//   [1584624600000, 244.78],
//   [1584711000000, 229.24],
//   [1584970200000, 224.37],
//   [1585056600000, 246.88],
//   [1585143000000, 245.52],
//   [1585229400000, 258.44],
//   [1585315800000, 247.74],
//   [1585575000000, 254.81],
//   [1585661400000, 254.29],
//   [1585747800000, 240.91],
//   [1585834200000, 244.93],
//   [1585920600000, 241.41],
//   [1586179800000, 262.47],
//   [1586266200000, 259.43],
//   [1586352600000, 266.07],
//   [1586439000000, 267.99],
//   [1586784600000, 273.25],
//   [1586871000000, 287.05],
//   [1586957400000, 284.43],
//   [1587043800000, 286.69],
//   [1587130200000, 282.8],
//   [1587389400000, 276.93],
//   [1587475800000, 268.37],
//   [1587562200000, 276.1],
//   [1587648600000, 275.03],
//   [1587735000000, 282.97],
//   [1587994200000, 283.17],
//   [1588080600000, 278.58],
//   [1588167000000, 287.73],
//   [1588253400000, 293.8],
//   [1588339800000, 289.07],
//   [1588599000000, 293.16],
//   [1588685400000, 297.56],
//   [1588771800000, 300.63],
//   [1588858200000, 303.74],
//   [1588944600000, 310.13],
//   [1589203800000, 315.01],
//   [1589290200000, 311.41],
//   [1589376600000, 307.65],
//   [1589463000000, 309.54],
//   [1589549400000, 307.71],
//   [1589808600000, 314.96],
//   [1589895000000, 313.14],
//   [1589981400000, 319.23],
//   [1590067800000, 316.85],
//   [1590154200000, 318.89],
//   [1590499800000, 316.73],
//   [1590586200000, 318.11],
//   [1590672600000, 318.25],
//   [1590759000000, 317.94],
//   [1591018200000, 321.85],
//   [1591104600000, 323.34],
//   [1591191000000, 325.12],
//   [1591277400000, 322.32],
//   [1591363800000, 331.5],
//   [1591623000000, 333.46],
//   [1591709400000, 343.99],
//   [1591795800000, 352.84],
//   [1591882200000, 335.9],
//   [1591968600000, 338.8],
//   [1592227800000, 342.99],
//   [1592314200000, 352.08],
//   [1592400600000, 351.59],
//   [1592491792000, 352.13],
// ];

// if ($('.chart-container')[0]) {
//   var width = document.querySelector('.chart-container').offsetWidth;
//   console.log(width);
//   document.addEventListener('DOMContentLoaded', function () {
//     Highcharts.stockChart('myChart', {
//       rangeSelector: {
//         selected: 1,
//       },

//       title: {
//         text: null,
//       },
//       subtitle: {
//         text: null,
//       },
//       navigator: {
//         enabled: false,
//       },
//       scrollbar: {
//         enabled: false,
//       },
//       zoom: {
//         enabled: false,
//       },
//       series: [
//         {
//           name: 'AAPL',
//           data: data,
//           navigator: false,
//           tooltip: {
//             valueDecimals: 2,
//           },
//         },
//       ],
//       responsive: {
//         rules: [
//           {
//             condition: {
//               maxWidth: 1400,
//             },
//             chartOptions: {
//               chart: {
//                 width: width,
//                 height: 300,
//               },
//               subtitle: {
//                 text: null,
//               },
//               navigator: {
//                 enabled: false,
//               },
//             },
//           },
//         ],
//       },
//     });
//   });
// }

// collapse
$('.btn-block').click(function () {
  $(this)
    .parent()
    .parent()
    .parent()
    .siblings()
    .find('.btn-block')
    .removeClass('clicked');
  $(this).toggleClass('clicked');
// });

// // sidebar investors page

// $('.Sidebar li a').click(function (e) {
//   e.preventDefault();
//   $(this).addClass('link_active');
//   $(this).parent().siblings().children('a').removeClass('link_active');

//   // show hide div
//   const href = $(this).attr('data-target');
//   if (href[0]) {
//     $('.main_Content').children().removeClass('shown');
//     $('.main_Content ' + href).addClass('shown');
//   } else {
//     console.log('not found');
//     return false;
//   }
});

// animation
AOS.init({
  once: true,
  offset: 120,
});

// navigation small screen dropdown

var win = window;
if (win.innerWidth < 1180) {
  $('.nav_items img').click(function () {
    $(this).parent().find('ul').slideToggle();
    $(this).parent().parent().children().find('ul').slideUp();
    $(this).parent().find('ul').clearQueue();
  });
}

$('#resume').change(function() {
  var file = $('#resume')[0].files[0].name;
  $(this).prev('label').text(file);
});

// submit jobs application form here
function SubmitForm() {
  console.log('herere');
  if (!validateForm(currentTab+1)) return false;
  document.getElementById('jobForm').submit();
}

function validateForm(step){
  let flag = true;
  if(step == 1){
    let ja_first_name = $("#ja-first-name");
    let ja_last_name = $("#ja-last-name");
    let ja_email = $("#ja-email");
    let ja_area_code = $("#ja-area-code");
    let ja_phone = $("#ja-phone");
    let ja_address_line_1 = $("#ja-address-line-1");
    let ja_city = $("#ja-city");
    // let ja_state = $("#ja-state");
    // let ja_zip_code = $("#ja-zip-code");
    // let ja_country = $("#ja-country");
    // let ja_citizen = $("#ja-citizen");

    let email_re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
    if(ja_first_name.val() == null || ja_first_name.val() == ""){
      ja_first_name.addClass("error");
      ja_first_name.siblings("p").html("First Name is required");
      ja_first_name.siblings("p").show();
      flag = false;
    }else{
      ja_first_name.removeClass("error");
      ja_first_name.siblings("p").hide();
    }

    if(ja_last_name.val() == null || ja_last_name.val() == ""){
      ja_last_name.addClass("error");
      ja_last_name.siblings("p").html("Last Name is required");
      ja_last_name.siblings("p").show();
      flag = false;
    }else{
      ja_last_name.removeClass("error");
      ja_last_name.siblings("p").hide();
    }

    if(ja_email.val() == null || ja_email.val() == ""){
      ja_email.addClass("error");
      ja_email.siblings("p").html("Email is required");
      ja_email.siblings("p").show();
      flag = false;
    }else if(ja_email.val() && !email_re.test(ja_email.val())){
      ja_email.addClass("error");
      ja_email.siblings("p").html("Email format should be abc@sample.com");
      ja_email.siblings("p").show();
      flag = false;
    }else{
      ja_email.removeClass("error");
      ja_email.siblings("p").hide();
    }

    if(ja_area_code.val() == null || ja_area_code.val() == ""){
      let area_code_error_msg = "Area Code is required";
      ja_area_code.addClass("error");
      ja_area_code.siblings("p").html(area_code_error_msg);
      ja_area_code.siblings("p").show();
      flag = false;
    }else if(ja_area_code.val() && (ja_area_code.val().length < 2 || ja_area_code.val().length > 3)){
        console.log(ja_area_code.val().length);
        area_code_error_msg = "Please enter at least 2 and no more than 3 digits.";
        ja_area_code.addClass("error");
        ja_area_code.siblings("p").html(area_code_error_msg);
        ja_area_code.siblings("p").show();
        flag = false;
    }else{
      ja_area_code.removeClass("error");
      ja_area_code.siblings("p").hide();
    }

    if(ja_phone.val() == null || ja_phone.val() == ""){
      let phone_error_msg = "Phone is required";
      ja_phone.addClass("error");
      ja_phone.siblings("p").html(phone_error_msg);
      ja_phone.siblings("p").show();
      flag = false;
    }else if(ja_phone.val() && (ja_phone.val().length < 7 || ja_phone.val().length > 9)){
        phone_error_msg = "Please enter at least 7 and no more than 9 digits.";
        ja_phone.addClass("error");
        ja_phone.siblings("p").html(phone_error_msg);
        ja_phone.siblings("p").show();
        flag = false;
    }else{
      ja_phone.removeClass("error");
      ja_phone.siblings("p").hide();
    }

    if(ja_address_line_1.val() == null || ja_address_line_1.val() == ""){
      ja_address_line_1.addClass("error");
      ja_address_line_1.siblings("p").html("Address is required");
      ja_address_line_1.siblings("p").show();
      flag = false;
    }else{
      ja_address_line_1.removeClass("error");
      ja_address_line_1.siblings("p").hide();
    }

    if(ja_city.val() == null || ja_city.val() == ""){
      ja_city.addClass("error");
      ja_city.siblings("p").html("City is required");
      ja_city.siblings("p").show();
      flag = false;
    }else{
      ja_city.removeClass("error");
      ja_city.siblings("p").hide();
    }

    // if(ja_state.val() == null || ja_state.val() == ""){
    //   ja_state.addClass("error");
    //   ja_state.siblings("p").html("State is required");
    //   ja_state.siblings("p").show();
    //   flag = false;
    // }else{
    //   ja_state.removeClass("error");
    //   ja_state.siblings("p").hide();
    // }

    // if(ja_zip_code.val() == null || ja_zip_code.val() == ""){
    //   ja_zip_code.addClass("error");
    //   ja_zip_code.siblings("p").html("Zip Code is required");
    //   ja_zip_code.siblings("p").show();
    //   flag = false;
    // }else{
    //   ja_zip_code.removeClass("error");
    //   ja_zip_code.siblings("p").hide();
    // }

    // if(ja_country.val() == null || ja_country.val() == ""){
    //   ja_country.addClass("error");
    //   ja_country.siblings("p").html("Country is required");
    //   ja_country.siblings("p").show();
    //   flag = false;
    // }else{
    //   ja_country.removeClass("error");
    //   ja_country.siblings("p").hide();
    // }

    // if(ja_citizen.val() == null || ja_citizen.val() == ""){
    //   ja_citizen.addClass("error");
    //   ja_citizen.siblings("p").html("Citizen is required");
    //   ja_citizen.siblings("p").show();
    //   flag = false;
    // }else{
    //   ja_citizen.removeClass("error");
    //   ja_citizen.siblings("p").hide();
    // }
  }
  // if(step == 2){
  //   let aws_available_start_date = $("#aws-available-start-date");
  //   let aws_current_employment_status = $("#aws-current-employment-status");
  //   let aws_past_massy_employee = $("#aws-past-massy-employee");
  //   let aws_past_massy_city = $("#aws-past-massy-city");
  //   let aws_past_massy_date = $("#aws-past-massy-date");
  //   let aws_current_base_salary = $("#aws-current-base-salary");
  //   let aws_other_benefits = $("#aws-other-benefits");
  //   let aws_incentive_earned_last_year = $("#aws-incentive-earned-last-year");
  //   let aws_value_of_other_benefits = $("#aws-value-of-other-benefits");
  //   let aws_tcc = $("#aws-tcc");
    
  //   if(aws_available_start_date.val() == null || aws_available_start_date.val() == ""){
  //     aws_available_start_date.addClass("error");
  //     $("#aws-available-start-date-error").html("Available Start Date is required");
  //     $("#aws-available-start-date-error").show();
  //     flag = false;
  //   }else{
  //     aws_available_start_date.removeClass("error");
  //     $("#aws-available-start-date-error").hide();
  //   }

  //   if(aws_current_employment_status.val() == null || aws_current_employment_status.val() == ""){
  //     aws_current_employment_status.addClass("error");
  //     aws_current_employment_status.siblings("p").html("Current Employment Status is required");
  //     aws_current_employment_status.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_current_employment_status.removeClass("error");
  //     aws_current_employment_status.siblings("p").hide();
  //   }

  //   if(aws_past_massy_employee.val() == null || aws_past_massy_employee.val() == ""){
  //     aws_past_massy_employee.addClass("error");
  //     aws_past_massy_employee.siblings("p").html("Past Massy Employee is required");
  //     aws_past_massy_employee.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_past_massy_employee.removeClass("error");
  //     aws_past_massy_employee.siblings("p").hide();
  //   }

  //   if(aws_past_massy_city.val() == null || aws_past_massy_city.val() == ""){
  //     aws_past_massy_city.addClass("error");
  //     aws_past_massy_city.siblings("p").html("Past Massy City is required");
  //     aws_past_massy_city.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_past_massy_city.removeClass("error");
  //     aws_past_massy_city.siblings("p").hide();
  //   }

  //   if(aws_past_massy_date.val() == null || aws_past_massy_date.val() == ""){
  //     aws_past_massy_date.addClass("error");
  //     $("#aws-past-massy-date-error").html("Past Massy Date is required");
  //     $("#aws-past-massy-date-error").show();
  //     flag = false;
  //   }else{
  //     aws_past_massy_date.removeClass("error");
  //     $("#aws-past-massy-date-error").hide();
  //   }

  //   if(aws_current_base_salary.val() == null || aws_current_base_salary.val() == ""){
  //     aws_current_base_salary.addClass("error");
  //     aws_current_base_salary.siblings("p").html("Current Base Salary is required");
  //     aws_current_base_salary.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_current_base_salary.removeClass("error");
  //     aws_current_base_salary.siblings("p").hide();
  //   }

  //   if(aws_other_benefits.val() == null || aws_other_benefits.val() == ""){
  //     aws_other_benefits.addClass("error");
  //     aws_other_benefits.siblings("p").html("Other Benefits is required");
  //     aws_other_benefits.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_other_benefits.removeClass("error");
  //     aws_other_benefits.siblings("p").hide();
  //   }

  //   if(aws_incentive_earned_last_year.val() == null || aws_incentive_earned_last_year.val() == ""){
  //     aws_incentive_earned_last_year.addClass("error");
  //     aws_incentive_earned_last_year.siblings("p").html("Incentive Earned Last Year is required");
  //     aws_incentive_earned_last_year.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_incentive_earned_last_year.removeClass("error");
  //     aws_incentive_earned_last_year.siblings("p").hide();
  //   }

  //   if(aws_value_of_other_benefits.val() == null || aws_value_of_other_benefits.val() == ""){
  //     aws_value_of_other_benefits.addClass("error");
  //     aws_value_of_other_benefits.siblings("p").html("Value Of Other Benefits is required");
  //     aws_value_of_other_benefits.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_value_of_other_benefits.removeClass("error");
  //     aws_value_of_other_benefits.siblings("p").hide();
  //   }

  //   if(aws_tcc.val() == null || aws_tcc.val() == ""){
  //     aws_tcc.addClass("error");
  //     aws_tcc.siblings("p").html("Total Cash Compensation is required");
  //     aws_tcc.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aws_tcc.removeClass("error");
  //     aws_tcc.siblings("p").hide();
  //   }
  // }
  // if(step == 3){
  //   let awh_employer_name = $("#awh-employer-name");
  //   let awh_employer_city = $("#awh-employer-city");
  //   let awh_employer_country = $("#awh-employer-country");
  //   let awh_position_held = $("#awh-position-held");
  //   let awh_start_date = $("#awh-start-date");
  //   let awh_finish_date = $("#awh-finish-date");
  //   let awh_duties = $("#awh-duties");
  //   let awh_reason_for_leaving = $("#awh-reason-for-leaving");
    
  //   if(awh_employer_name.val() == null || awh_employer_name.val() == ""){
  //     awh_employer_name.addClass("error");
  //     awh_employer_name.siblings("p").html("Employer Name is required");
  //     awh_employer_name.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_employer_name.removeClass("error");
  //     awh_employer_name.siblings("p").hide();
  //   }

  //   if(awh_employer_city.val() == null || awh_employer_city.val() == ""){
  //     awh_employer_city.addClass("error");
  //     awh_employer_city.siblings("p").html("Employment City is required");
  //     awh_employer_city.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_employer_city.removeClass("error");
  //     awh_employer_city.siblings("p").hide();
  //   }

  //   if(awh_employer_country.val() == null || awh_employer_country.val() == ""){
  //     awh_employer_country.addClass("error");
  //     awh_employer_country.siblings("p").html("Employer Country is required");
  //     awh_employer_country.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_employer_country.removeClass("error");
  //     awh_employer_country.siblings("p").hide();
  //   }

  //   if(awh_position_held.val() == null || awh_position_held.val() == ""){
  //     awh_position_held.addClass("error");
  //     awh_position_held.siblings("p").html("Position Held is required");
  //     awh_position_held.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_position_held.removeClass("error");
  //     awh_position_held.siblings("p").hide();
  //   }

  //   if(awh_start_date.val() == null || awh_start_date.val() == ""){
  //     awh_start_date.addClass("error");
  //     $("#awh-start-date-error-msg").html("Start Date is required");
  //     $("#awh-start-date-error-msg").show();
  //     flag = false;
  //   }else{
  //     awh_start_date.removeClass("error");
  //     $("#awh-start-date-error-msg").hide();
  //   }

  //   if(awh_finish_date.val() == null || awh_finish_date.val() == ""){
  //     awh_finish_date.addClass("error");
  //     $("#awh-finish-date-error-msg").html("Finish Date is required");
  //     $("#awh-finish-date-error-msg").show();
  //     flag = false;
  //   }else{
  //     awh_finish_date.removeClass("error");
  //     $("#awh-finish-date-error-msg").hide();
  //   }

  //   if(awh_duties.val() == null || awh_duties.val() == ""){
  //     awh_duties.addClass("error");
  //     awh_duties.siblings("p").html("Duties is required");
  //     awh_duties.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_duties.removeClass("error");
  //     awh_duties.siblings("p").hide();
  //   }

  //   if(awh_reason_for_leaving.val() == null || awh_reason_for_leaving.val() == ""){
  //     awh_reason_for_leaving.addClass("error");
  //     awh_reason_for_leaving.siblings("p").html("Reason For Leaving is required");
  //     awh_reason_for_leaving.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_reason_for_leaving.removeClass("error");
  //     awh_reason_for_leaving.siblings("p").hide();
  //   }
  // }
  // if(step == 4){
  //   let awh_employer_name_additional = $("#awh-employer-name-additional");
  //   let awh_employer_city_additional = $("#awh-employer-city-additional");
  //   let awh_employer_country_additional = $("#awh-employer-country-additional");
  //   let awh_position_held_additional = $("#awh-position-held-additional");
  //   let awh_start_date_additional = $("#awh-start-date-additional");
  //   let awh_finish_date_additional = $("#awh-finish-date-additional");
  //   let awh_duties_additional = $("#awh-duties-additional");
  //   let awh_reason_for_leaving_additional = $("#awh-reason-for-leaving-additional");
    
  //   if(awh_employer_name_additional.val() == null || awh_employer_name_additional.val() == ""){
  //     awh_employer_name_additional.addClass("error");
  //     awh_employer_name_additional.siblings("p").html("Employer Name is required");
  //     awh_employer_name_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_employer_name_additional.removeClass("error");
  //     awh_employer_name_additional.siblings("p").hide();
  //   }

  //   if(awh_employer_city_additional.val() == null || awh_employer_city_additional.val() == ""){
  //     awh_employer_city_additional.addClass("error");
  //     awh_employer_city_additional.siblings("p").html("Employment City is required");
  //     awh_employer_city_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_employer_city_additional.removeClass("error");
  //     awh_employer_city_additional.siblings("p").hide();
  //   }

  //   if(awh_employer_country_additional.val() == null || awh_employer_country_additional.val() == ""){
  //     awh_employer_country_additional.addClass("error");
  //     awh_employer_country_additional.siblings("p").html("Employer Country is required");
  //     awh_employer_country_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_employer_country_additional.removeClass("error");
  //     awh_employer_country_additional.siblings("p").hide();
  //   }

  //   if(awh_position_held_additional.val() == null || awh_position_held_additional.val() == ""){
  //     awh_position_held_additional.addClass("error");
  //     awh_position_held_additional.siblings("p").html("Position Held is required");
  //     awh_position_held_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_position_held_additional.removeClass("error");
  //     awh_position_held_additional.siblings("p").hide();
  //   }

  //   if(awh_start_date_additional.val() == null || awh_start_date_additional.val() == ""){
  //     awh_start_date_additional.addClass("error");
  //     $("#awh-start-date-additional-error-msg").html("Start Date is required");
  //     $("#awh-start-date-additional-error-msg").show();
  //     flag = false;
  //   }else{
  //     awh_start_date_additional.removeClass("error");
  //     $("#awh-start-date-additional-error-msg").hide();
  //   }

  //   if(awh_finish_date_additional.val() == null || awh_finish_date_additional.val() == ""){
  //     awh_finish_date_additional.addClass("error");
  //     $("#awh-finish-date-additional-error-msg").html("Finish Date is required");
  //     $("#awh-finish-date-additional-error-msg").show();
  //     flag = false;
  //   }else{
  //     awh_finish_date_additional.removeClass("error");
  //     $("#awh-finish-date-additional-error-msg").hide();
  //   }

  //   if(awh_duties_additional.val() == null || awh_duties_additional.val() == ""){
  //     awh_duties_additional.addClass("error");
  //     awh_duties_additional.siblings("p").html("Duties is required");
  //     awh_duties_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_duties_additional.removeClass("error");
  //     awh_duties_additional.siblings("p").hide();
  //   }

  //   if(awh_reason_for_leaving_additional.val() == null || awh_reason_for_leaving_additional.val() == ""){
  //     awh_reason_for_leaving_additional.addClass("error");
  //     awh_reason_for_leaving_additional.siblings("p").html("Reason For Leaving is required");
  //     awh_reason_for_leaving_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     awh_reason_for_leaving_additional.removeClass("error");
  //     awh_reason_for_leaving_additional.siblings("p").hide();
  //   }
  // }
  if(step == 5){
    let aai_criminal_offender = $("#aai-criminal-offender");
    // let aai_offence_reasons = $("#aai-offence-reasons");
    let aai_employed_under_other_name = $("#aai-employed-under-other-name");
    // let aai_reason_for_leaving = $("#aai-reason-for-leaving");
    
    if(aai_criminal_offender.val() == null || aai_criminal_offender.val() == ""){
      aai_criminal_offender.addClass("error");
      aai_criminal_offender.siblings("p").html("This field is required");
      aai_criminal_offender.siblings("p").show();
      flag = false;
    }else{
      aai_criminal_offender.removeClass("error");
      aai_criminal_offender.siblings("p").hide();
    }

    // if(aai_offence_reasons.val() == null || aai_offence_reasons.val() == ""){
    //   aai_offence_reasons.addClass("error");
    //   aai_offence_reasons.siblings("p").html("Offence Reasons is required");
    //   aai_offence_reasons.siblings("p").show();
    //   flag = false;
    // }else{
    //   aai_offence_reasons.removeClass("error");
    //   aai_offence_reasons.siblings("p").hide();
    // }

    if(aai_employed_under_other_name.val() == null || aai_employed_under_other_name.val() == ""){
      aai_employed_under_other_name.addClass("error");
      aai_employed_under_other_name.siblings("p").html("This field is required");
      aai_employed_under_other_name.siblings("p").show();
      flag = false;
    }else{
      aai_employed_under_other_name.removeClass("error");
      aai_employed_under_other_name.siblings("p").hide();
    }

    // if(aai_reason_for_leaving.val() == null || aai_reason_for_leaving.val() == ""){
    //   aai_reason_for_leaving.addClass("error");
    //   aai_reason_for_leaving.siblings("p").html("Reason For Leaving is required");
    //   aai_reason_for_leaving.siblings("p").show();
    //   flag = false;
    // }else{
    //   aai_reason_for_leaving.removeClass("error");
    //   aai_reason_for_leaving.siblings("p").hide();
    // }
  }
  // if(step == 6){
  //   let aeh_school_name = $("#aeh-school-name");
  //   let aeh_school_degree = $("#aeh-school-degree");
  //   let aeh_school_graduated = $("#aeh-school-graduated");
  //   let aeh_college_name = $("#aeh-college-name");
  //   let aeh_college_degree = $("#aeh-college-degree");
  //   let aeh_college_graduated = $("#aeh-college-graduated");
    
  //   if(aeh_school_name.val() == null || aeh_school_name.val() == ""){
  //     aeh_school_name.addClass("error");
  //     aeh_school_name.siblings("p").html("School Name is required");
  //     aeh_school_name.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_school_name.removeClass("error");
  //     aeh_school_name.siblings("p").hide();
  //   }

  //   if(aeh_school_degree.val() == null || aeh_school_degree.val() == ""){
  //     aeh_school_degree.addClass("error");
  //     aeh_school_degree.siblings("p").html("School Degree is required");
  //     aeh_school_degree.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_school_degree.removeClass("error");
  //     aeh_school_degree.siblings("p").hide();
  //   }

  //   if(aeh_school_graduated.val() == null || aeh_school_graduated.val() == ""){
  //     aeh_school_graduated.addClass("error");
  //     aeh_school_graduated.siblings("p").html("This Field is required");
  //     aeh_school_graduated.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_school_graduated.removeClass("error");
  //     aeh_school_graduated.siblings("p").hide();
  //   }

  //   if(aeh_college_name.val() == null || aeh_college_name.val() == ""){
  //     aeh_college_name.addClass("error");
  //     aeh_college_name.siblings("p").html("College Name is required");
  //     aeh_college_name.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_college_name.removeClass("error");
  //     aeh_college_name.siblings("p").hide();
  //   }

  //   if(aeh_college_degree.val() == null || aeh_college_degree.val() == ""){
  //     aeh_college_degree.addClass("error");
  //     aeh_college_degree.siblings("p").html("College Degree is required");
  //     aeh_college_degree.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_college_degree.removeClass("error");
  //     aeh_college_degree.siblings("p").hide();
  //   }

  //   if(aeh_college_graduated.val() == null || aeh_college_graduated.val() == ""){
  //     aeh_college_graduated.addClass("error");
  //     aeh_college_graduated.siblings("p").html("This Field is required");
  //     aeh_college_graduated.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_college_graduated.removeClass("error");
  //     aeh_college_graduated.siblings("p").hide();
  //   }
  // }
  // if(step == 7){
  //   let aeh_school_name_additional = $("#aeh-school-name-additional");
  //   let aeh_school_degree_additional = $("#aeh-school-degree-additional");
  //   let aeh_school_graduated_additional = $("#aeh-school-graduated-additional");
  //   let aeh_college_name_additional = $("#aeh-college-name-additional");
  //   let aeh_college_degree_additional = $("#aeh-college-degree-additional");
  //   let aeh_college_graduated_additional = $("#aeh-college-graduated-additional");
    
  //   if(aeh_school_name_additional.val() == null || aeh_school_name_additional.val() == ""){
  //     aeh_school_name_additional.addClass("error");
  //     aeh_school_name_additional.siblings("p").html("School Name is required");
  //     aeh_school_name_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_school_name_additional.removeClass("error");
  //     aeh_school_name_additional.siblings("p").hide();
  //   }

  //   if(aeh_school_degree_additional.val() == null || aeh_school_degree_additional.val() == ""){
  //     aeh_school_degree_additional.addClass("error");
  //     aeh_school_degree_additional.siblings("p").html("School Degree is required");
  //     aeh_school_degree_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_school_degree_additional.removeClass("error");
  //     aeh_school_degree_additional.siblings("p").hide();
  //   }

  //   if(aeh_school_graduated_additional.val() == null || aeh_school_graduated_additional.val() == ""){
  //     aeh_school_graduated_additional.addClass("error");
  //     aeh_school_graduated_additional.siblings("p").html("This Field is required");
  //     aeh_school_graduated_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_school_graduated_additional.removeClass("error");
  //     aeh_school_graduated_additional.siblings("p").hide();
  //   }

  //   if(aeh_college_name_additional.val() == null || aeh_college_name_additional.val() == ""){
  //     aeh_college_name_additional.addClass("error");
  //     aeh_college_name_additional.siblings("p").html("College Name is required");
  //     aeh_college_name_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_college_name_additional.removeClass("error");
  //     aeh_college_name_additional.siblings("p").hide();
  //   }

  //   if(aeh_college_degree_additional.val() == null || aeh_college_degree_additional.val() == ""){
  //     aeh_college_degree_additional.addClass("error");
  //     aeh_college_degree_additional.siblings("p").html("College Degree is required");
  //     aeh_college_degree_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_college_degree_additional.removeClass("error");
  //     aeh_college_degree_additional.siblings("p").hide();
  //   }

  //   if(aeh_college_graduated_additional.val() == null || aeh_college_graduated_additional.val() == ""){
  //     aeh_college_graduated_additional.addClass("error");
  //     aeh_college_graduated_additional.siblings("p").html("This Field is required");
  //     aeh_college_graduated_additional.siblings("p").show();
  //     flag = false;
  //   }else{
  //     aeh_college_graduated_additional.removeClass("error");
  //     aeh_college_graduated_additional.siblings("p").hide();
  //   }
  // }
  return flag;
}

$('#job-title').keypress(function (e) {
  if (e.which == 13) {
    showjobs();
    return false;
  }
});

function showjobs(){
  let title = $("#job-title").val();
  let country = $("#job-country").val();
  let sector = $("#job-sector").val();
  let _function = $("#job-function").val();

  var base_url = window.location.origin;
  window.location.href = base_url+"/careers?jobs=search&title="+title+"&country="+country+"&sector="+sector+"&function="+_function;
}

