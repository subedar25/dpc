<?php if (isset($settingData['TOP_CONTENT']) && $settingData['TOP_CONTENT']) {
    $top_message = $settingData['TOP_CONTENT'] ?>
    <div class="text2">
        <h1 style="font-size: 16px;color: #000;padding-bottom: 3px;">Satta Matka DPBOSS Kalyan Matka Result</h1>
        <h2 style="color: #444;font-size: 14px;"> <?php echo $top_message; ?> </h2>
    </div>

<?php } ?>



<?php if ((isset($settingData['MOTOR_PATTI']) && $settingData['MOTOR_PATTI']) || (isset($settingData['CYCLE_PATTI']) && $settingData['CYCLE_PATTI'])) { ?>

    <div class="f-pti">
        <h3>Today Lucky Number</h3>
        <div class="dflex">
            <div class="j52g4" style="border-right: 1px solid #ff0016;width:40%">
                <h4>Golden Ank</h4>
                <p><?php echo !empty($settingData['CYCLE_PATTI']) ? (esc($settingData['CYCLE_PATTI'])) : "&nbsp;"; ?></p>
            </div>
            <div class="j52g4" style="width:60%">
                <h4>Final Ank</h4>
                <div class="amthltg">
                    <p>
                        <?php echo !empty($settingData['MOTOR_PATTI']) ? nl2br(esc($settingData['MOTOR_PATTI'])) : "&nbsp;"; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<div class="text2" style="margin-bottom: 7px;font-size:16px;padding: 7px;line-height: 25px;">
    <span style="background: #b80000;color:white;display: block;text-shadow:0px 0px 5px black;font-size: 20px;font-weight: bold;">☆ NOTICE ☆</span>
    Worlds nomber one - dpboss.cash support by dpboss
</div>


<!-- live result -->
 <?php echo view("user/_liveresult"); ?>



<div class="text2" style="margin-bottom: 7px;font-size:16px;padding: 7px;line-height: 25px;">
    <span style="background: #b80000;color:white;display: block;text-shadow:0px 0px 5px black;font-size: 20px;font-weight: bold;">☆ NOTICE ☆</span>
    अपना बाजार Dpbossboston.online वेबसाइट में डलवाने <br>
    के लिए आज ही हमें ईमेल करे <br>
    <a style="color:#522f92;" href="mailto:support@dpboss.cash">Email : support@dpboss.cash</a>
    <br>
    शर्ते लागु
</div>

<div>
    <div class="text3">KALYAN MATKA | MATKA RESULT | KALYAN MATKA TIPS | SATTA MATKA | MATKA.COM | MATKA PANA JODI
        TODAY | BATTA SATKA | MATKA PATTI JODI NUMBER | MATKA RESULTS | MATKA CHART | MATKA JODI | SATTA COM | FULL
        RATE GAME | MATKA GAME | MATKA WAPKA | ALL MATKA RESULT LIVE ONLINE | MATKA RESULT | KALYAN MATKA RESULT |
        DPBOSS MATKA 143 | MAIN MATKA</div>
</div>

<!-- world me saabse fast -->
<?php echo view("user/_index_all_result", [
    'todayresultData' => $todayresultData ?? [],
    'settingData' => $settingData ?? []
]); ?>

<div class="eml-us">
    <p>Email for any inquiries Or Support:</p>
    <a href="mailto:support@dpboss.cash">support@dpboss.cash</a>
</div>


 <?php // echo view("user/_multipleresult"); ?>

<!-- Matka Jodi List -->
 <?php echo view("user/_matkajodichart"); ?>
 <?php echo view("user/_weeklyjodichart"); ?>



<div class="oc-fg">
   <?php echo view("user/_freegamezone"); ?>
   <?php echo view("user/_tableresult"); ?>

   <div class="sta-div sta-1">
        <h6>SATTA MATKA JODI CHART</h6>

        <?php    foreach ($todayresultData as $resultdata) { ?>
        <a href="<?php echo site_url('jodichart?id=' . $resultdata['id']); ?>"><?php echo $resultdata['name']; ?></a>

        <?php } ?>
        
    </div>

      <div class="sta-div sta-1">
        <h6>MATKA PANEL CHART</h6>

         <?php    foreach ($todayresultData as $resultdata) { ?>
        <a href="<?php echo site_url('panelchart?id=' . $resultdata['id']); ?>"><?php echo $resultdata['name']; ?></a>

        <?php } ?>
        
    </div>
    
   


    

    <div class="qtn14">
        <h6>Introduction to DPBOSS Service</h6>
        <p>
            Welcome to DPBOSS, where entertainment takes center stage, and a world of diverse activities awaits you. In our vibrant community, we've crafted an experience beyond conventional platforms, offering a rich tapestry of entertainment for users with varied interests.
            <br><br>
            Discover the joy of connecting with like-minded individuals through our socializing features. Whether you're an extrovert seeking lively conversations or an introvert looking for a cozy virtual space, DPBOSS is your go-to destination for meaningful connections.
            <br><br>
            DPBOSS is your ultimate destination for everything related to the fascinating world of the Satta Matka. As the DPBOSS is a leading authority in the realm of Matka Games, this is your Go-To Platform for any reliable information along with accurate Matka Results and expert guidance obviously. Whether you are a pro or a newcomer player the comprehensive collection of resources such as Kalyan Matka, Matka Result, and Mumbai Matka, will provide you with the thrilling and immersive experience. Join us along and we will embark on this captivating adventure, where every matka number, matka chart, and matka games hold the potential to unlock fortunes.
        </p>
        <div class="q-crd a25hc"> <label for="qtn141"> <span> HISTORY OF SATTA MATKA </span> </label>
            <div class="g5v2a">
                <p>The history of Satta Matka dates to the 1960s when it originated as a form of gambling in Mumbai, India. Initially, it involved betting on the opening and closing rates of cotton in the Bombay cotton exchange. The practice of placing bets on the fluctuating cotton rates attracted a significant number of people looking to try their luck.<br>

                    As the popularity of this form of gambling grew, it expanded beyond the cotton exchange. The game underwent several modifications and evolved into a numbers-based betting system. Players began betting on random numbers ranging from 0 to 9, which were drawn from a Matka (earthen pot).<br>
                    Along with time various Matka Markets came out known as Kalyan Matka, Mumbai Matka, Rajdhani Matka, Night Milan Matka, And Main Mumbai Matka, among others. Every market has their own set of rules and draws which provides player with different opportunities in the game.
                </p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn142"> <span> TYPES OF SATTA MATKA </span> </label>
            <div class="g5v2a">
                <p>Kalyan Matka: Kalyan Matka is one of the most popular variants of Satta Matak which focuses on betting that are based on opening and closing of cotton in the Bombay Cotton Exchange. They have their own rules of draws for the declaration of winning outcome. <br>

                    Mumbai Matka: Mumbai Matka is the format of satta matka associated with Mumbai. The game includes various draw which helps player to place bet on different number and combinations. <br>

                    Rajdhani Matka: It is another type of Matka which involves betting on number based which is upon the opening and closing rates of the cotton in the Rajdhani Cotton Exchange. <br>

                    Night Milan Matka: It is another variant of Satta Matka which is played at the evening or the night hours which offers exciting benefits to player looking to try their luck after the sunset. <br>

                    Main Mumbai Matka: It is officially focused on Mumbai with their own sets of rules, draws and betting options for the people interested in the Main Mumbai Market. <br>

                    Gali Deshawar Matka: Gali Deshawar Matka is a specific variant of Satta Matka popular in certain regions of India. It involves betting on numbers and predicting the outcome based on the draw.<br>

                    Milan Day Matka: Milan Day Matka is a daytime variant of Satta Matka, providing players with betting opportunities during the day, with its own set of rules and draws separate from the night games.
                </p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn143"> <span> THE BASICS OF MATKA: </span> </label>
            <div class="g5v2a">
                <p>Matka game officially originated in India 1960s. It is a very popular lottery style which involves betting on number and combination and if the result drawn matched your combination the layer can win potential amount. The term "Satta" refers to "betting" in Hindi, while "Matka" means "Earthen Pot" in hindi, traditionally used to draw random numbers.<br>

                    Game Format: The Satta Matka games are mainly played on the days when market are closed such as weekends or public holidays. It generally includes playing bets on set of numbers from 0 to 9 and the result is drawn randomly. <br>

                    Betting Process: Players need to place bet on the comniation of number on the opening and closi times of the Satta Market. Bets placed are on different types of market and options which includes single Jodi (pair), patti (three-digit number), and more.<br>

                    Matka Draw: The Matka Draw involves drawing any of the three numbers from 0 to 9 from the deck of cards. The numbers are made drawn twice so that it creates a two digit number such as number drawn are 5 and 3 then the result is 53. This process is repeated to obtain the second set of numbers.<br>

                    Result Declaration: The Winning numbers are declared based on the different combination of two set numbers. As an example, as the first set is 53 whereas the second to be 46 then the result will be 53 x 46. Although mostly the result if od 2-digit number and of that the last digit is taken into consideration as the last digit is 6 the winning number is declared 6. <br>

                    Payouts: Payouts in Satta Matka also varies depending on the various types of bets placed and the amount it includes. As different market has their own different payout ratios and if the player wins, they receive the predetermined amount multiplies by their betting amount.
                </p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn144"> <span> DIFFERENT VARIANTS OF MATKA GAMES </span> </label>
            <div class="g5v2a">
                <p>There are several variants of Matka Games that have emerged over time. Here are some of the popular ones:<br>

                    Single: in this format the player needs to bet on the single digit from 0 to 9 and if there chosen number draws out, they win. <br>

                    Jodi: In Jodi player need to choose two numbers so that they can form pair of number they need to choose from 00 to 99 and if there selected number is drawn out, they win. <br>

                    Patti: Patti is a three-digit number variant where players bet on all three digits of the result. There are different types of patti bets, including single patti, double patti, and triple patti.<br>

                    Half Sangam: Half Sangam is a kind of combination bet which includes one number chosen in front the list of numbers and pairs along with he other number from the second set. <br>

                    Full Sangam: The Full sangam is just like the half sangam as player select two numbers from both set and if it is drawn, they win. <br>
                    Cycle Patti: Cycle Patti is a variation where players bet on a set of three numbers in a specific order. If their selected cycle matches the result, they win.

                </p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn145"> <span>WHAT IS KALYAN MATKA AND ITS WINNING STRATEGY </span> </label>
            <div class="g5v2a">
                <p> Kalyan Matka is a popular form of gambling that originated in India, focusing on the opening, and closing rates of cotton traded on the Bombay Cotton Exchange. Over time, it has evolved into a game where players bet on numbers and combinations, like other Matka Games. Here are some tips for playing Kalyan Matka:

                    1. Understand the game rules and different types of bets.<br>
                    2. Analyze past results for patterns, but remember that outcomes are based on chance.<br>
                    3. Set a budget and stick to it.<br>
                    4. Diversify your bets to minimize risks.<br>
                    5. Bet with reasonable amounts and avoid chasing losses.<br>
                    6. Control your emotions and make rational decisions.<br>
                    7. Stay updated with the latest information and market trends.
                    <br>



                </p>
            </div>
        </div>
    </div>

    <div class="be-stone">
        <div class="c-stone" style="  margin-top: 0 ;border-top: 0 ;">WHAT IS MUMBAI MATKA? </div>
        <p>The variant of the Matka gambling game which originated in Mumbai, India is known as Mumbai Matka. The game is specifically associated with the city of Mumbai and hence is known as the Mumbai Matka. As other Matka games Mumbai Matka also revolves around the number and combinations.
        </p>
        <div class="c-stone">WHAT IS RAJDHANI MATKA? </div>
        <p>Rajdhani Matka is a very popular matka game and variant of Matka gambling in India. The game involves betting on number and combinations in Rajdhani market as player places the bets on various options such as single number or pair or even the three-digit number before the result gets declared. The games revolve on the similar format of other Matka games where two sets of number are drawn at a random. Even if you want to know how the result is declared so the winning number are determined based on the combination of two sets as the last digit of their products is determined as the winning number. Also, while playing the game, it is that you follow the local laws and regulations while participating in the Rajdhani Matka or any other Format of games.
        </p>
        <div class="c-stone">WHAT IS SATTA CHART ANALYSIS?</div>
        <p>The Satta Chart Analysis is the study of historical Satta Matka to identify the patterns along with trends and number of frequencies. By using this it helps in making decisions when you select a number or the combination for future bets. Although it is very to remember that the outcomes are totally based on chances and analysis does not guarantee any accurate predictions. Also, you need to make sure you gamble responsibility within legal boundaries
        </p>
        <div class="c-stone">WHAT IS MATKA OPEN AND MATKA CLOSE? </div>
        <p>"Matka Open" is the first set of numbers that are announced or declared at the beginning of a specific Matka game. It represents the opening result or the initial set of winning numbers. "Matka Close" is the second set of numbers that are announced or declared at the end of the Matka game. It represents the closing result or the final set of winning numbers. The time interval between the Matka Open and Matka Close varies depending on the specific Matka game being played. It can range from a few minutes to several hours, depending on the rules and regulations of the Matka market or game. Players place their bets on different numbers or combinations before the Matka Open, and the winning numbers are determined by the Matka Close

        </p>
        <div class="c-stone">MATKA JODI ON DPBOSS: COMBINING NUMBERS FOR WINNING BETS</div>
        <p>Matka Jodi is a term which is often used in Matka gambling to refer a combination of two mars that the player selected for their bets. The Jodi officially refers to the number which are combined to form single outcome. Below are few of the key points about the Matka Jodi: <br>

            Number Combination: Players need to choose a number from 0 to 9 and combine them to create any pair as for example if they select 3 and 7 the Jodi would be 37.<br>

            Betting Process: Players have full right to place bet on different Jodi available in the Matka game. They can select the Jodi bases on previous games and strategies and its analysis. <br>

            Result Declaration: If talking about the result declaration then the Jodi is compared to the winning numbers and if the Jodi outcome matches the player who placed the bet wins the potential amount. As for example if the winning number is declared as 3 and 7 and the Jodi combination was 37 then it would be the winning combination. <br>

            Payouts: The payouts totally depend on the specific Matka Market and their associated odds with chosen Jodi. As different Jodi combinations may have various payout rates.
        </p>
        <div class="c-stone">BOMBAY SATTA GUESSING AND TIPS</div>
        <p>Bombay Satta which is also known as the Mumbai Satta or Mumbai Matka refers to various and historical Matka gambling scenes in Mumbai city. The Matka game was originally originated in 1960s and was centred around the cotton exchange market of the Mumbai which later became a very popular form of gambling. <br>

            In Bombay Satta players need to place bets on various combination of numbers which can range from single digit to three-digit numbers. And if you predict the right number, you can win a potential winning at the time of result declaration. These numbers are then declared as the "open" and "close" for the day.<br>

            Mumbai has been a great hub for Matka gambling since a long time now and has various Matka markets operating in different area of the city. Some of the most known matka market are Kalyan Matka, Worli Matka. Milan Day and Rajdhani Night. And it is to know that every Market has their own sets of rules and timing for the declaration of results.
        </p>

    </div>




    <div class="qtn14">

        <div class="q-crd a25hc">
            <label for="qtn141">
                <span> WHAT IS SATTA MATKA? </span>
            </label>
            <div class="g5v2a">
                <p>Satta Matka originated in India and is one of the popular forms of Lottery and gambling games. The game involves placing bets on different numbers and earning potential winning on the outcome. </p>
            </div>
        </div>

        <div class="q-crd"> <label for="qtn142"> <span> WHO IS DPBOSS </span> </label>
            <div class="g5v2a">
                <p>DPBOSS is known for providing the best tips and guidance to players along with expert advice so that they can easily make informed decisions on placing bets on the numbers in their Matka Games. </p>
            </div>
        </div>



        <div class="q-crd"> <label for="qtn143"> <span> HOW DOES MATKA WORK? </span> </label>
            <div class="g5v2a">
                <p>In Matka, players need to choose a specific set of numbers from any predefined range and place bets on these numbers so that while any random number drawn if the number is the same the player chooses, they win. </p>
            </div>
        </div>

        <div class="q-crd"> <label for="qtn144"> <span> WHAT IS KALYAN MATKA? </span> </label>
            <div class="g5v2a">
                <p>Kalyan Matka is totally a variant of Satta Matka which mainly focuses on games based on opening and closing rates of cotton in the Bombay Cotton Exchange. </p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> HOW CAN I CHECK THE MATKA RESULT? </span> </label>
            <div class="g5v2a">
                <p> Matka results can be checked through various online platforms or websites that are totally dedicated to Satta Matka games. Various formats of Matka gaming results are declared on these platforms for ease. </p>
            </div>
        </div>

        <div class="q-crd"> <label for="qtn145"> <span> WHAT IS MATKA CHART? </span> </label>
            <div class="g5v2a">
                <p>The Matka Chart refers to the graphical representation of any previous result and trends which in Matka Game helps players analyze the patterns of drawing and make predictions for their future games. </p>
            </div>
        </div>



        <div class="q-crd"> <label for="qtn145"> <span> WHAT IS THE DIFFERENCE BETWEEN MATKA AND SATTA? </span> </label>
            <div class="g5v2a">
                <p> Satta is a broad term that refers to any type of gambling games. The matka is a specific term which refers to a game involving betting on numbers that are drawn out from the Matka. </p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> WHAT ARE MATKA OPEN AND MATKA CLOSE? </span> </label>
            <div class="g5v2a">
                <p> First and last numbers are referred to as the Matka Open and Matka Close, respectively which is drawn in any Matka Game. Even players can place bets on these numbers and win if they are potentially drawn out.</p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> WHAT ARE MATKA PANNA AND MATKA JODI? </span> </label>
            <div class="g5v2a">
                <p> In Matka Panna it is all about the three-digit number which represents a panel whereas the Jodi represents to a pair of two digit number where players can place the bets on Panna or Jodi combinations to increase any chances of winning. </p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> WHAT IS FIX SATTA? </span> </label>
            <div class="g5v2a">
                <p> Any predetermined or fixed set of numbers refers to the Fix Satta. It is very beneficial for the players who have access to the information as the outcomes are already redecided. </p>
            </div>
        </div>

        <div class="q-crd"> <label for="qtn145"> <span> WHAT IS LUCKY ONLINE MATKA? </span> </label>
            <div class="g5v2a">
                <p> The Lucky Online Matka game refers to an online gaming platform where player can easily participate in the Matka Games and try their luck by placing various bets on numbers and combinations to win a huge amount. </p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> LIVE MATKA </span> </label>
            <div class="g5v2a">
                <p> It is another variant of Satta Matka which involves real time streaming or updating of Matka Games which allows the player to witness the draw and there result at the real time which helps in providing more transparency and excitement among players to participate in it. </p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> GALI DESHAWAR MATKA </span> </label>
            <div class="g5v2a">
                <p> It is one of the variants of Satta Matka Game which is popular in various regions of India and is known as Gali Deshawar Matka. It also includes the same strategy that is betting on the number and predicting the outcome based on the draw system. </p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> BOMBAY SATTA </span> </label>
            <div class="g5v2a">
                <p> Bombay Satta refers to the Satta Matka game which is specifically tailored with the city of Mumbai or also Bombay. Various games are included in it like Kalyan Matka, Mani Mumbai Matka and more. </p>
            </div>
        </div>


        <div class="q-crd"> <label for="qtn145"> <span> SATTAMATKA TIPS</span> </label>
            <div class="g5v2a">
                <p>SattaMatka tips are suggestions and strategies provided by the experts of the field and players to improve your chances of winning in the Matka game. The tips provided by the experts may include analyzing previous results or following patterns or using any mathematical calculations. </p>
            </div>
        </div>

        <div class="q-crd"> <label for="qtn145"> <span> SATTA MATKA WORLD </span> </label>
            <div class="g5v2a">
                <p> Satta Matka World refers to the vast community of players and websites which provides resources dedicated to satta matka. It encompasses all the online platforms, forums and informational hub which cater to gaming enthusiasts. If you want to provide any information, feel free to do it or areas you like to focus and we will tailor content according to your preferences. </p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn145"> <span> सट्टा मटका क्या है? </span> </label>
            <div class="g5v2a">
                <p> सट्टा मटका एक जुआ है जो भारत में उत्पन्न हुआ था, जिसमें न्यू यॉर्क कॉटन एक्सचेंज से मुंबई कॉटन एक्सचेंज की ओपनिंग और क्लोजिंग दरों पर सट्टा लगाई जाती थी।</p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn145"> <span> सट्टा मटकाकैसे खेलें? </span> </label>
            <div class="g5v2a">
                <p> सट्टा मटका में खेलने के लिए आपको नंबर चुनना होता है और उन पर सट्टा लगाना होता है। खेल में विभिन्न प्रारूप होते हैं, जैसे कि सिंगल, जोड़ी, पन्ना, और संगम।</p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn145"> <span>सट्टा मटकामें जीतने के चांस कैसे बढ़ाएं?</span> </label>
            <div class="g5v2a">
                <p> सट्टा मटका में जीतने के चांस को बढ़ाने के लिए नियमों को समझें, रुझानों का पालन करें, और जिम्मेदार जुआ खेलें।</p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn145"> <span> कल्याण मटका क्या होता है? </span> </label>
            <div class="g5v2a">
                <p> कल्याण मटका एक प्रकार का सट्टा मटका बाजार है जो भारत में खेला जाता है। इसमें विभिन्न प्रकार की बेट लगाई जाती है जैसे कि ओपन, क्लोज, जोड़ियाँ आदि।</p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn145"> <span> मटका कैसे काम करता है? </span> </label>
            <div class="g5v2a">
                <p> मटका में, खिलाड़ियों को किसी पूर्वनिर्धारित सीमा से एक विशिष्ट सेट के नंबर चुनने की आवश्यकता होती है और इन नंबरों पर सट्टा लगानी होती है, ताकि किसी भी रैंडम नंबर ड्रा होते समय यदि नंबर वही हो जिसे खिलाड़ी ने चुना है, तो वह जीतते हैं।</p>
            </div>
        </div>
        <div class="q-crd"> <label for="qtn145"> <span> मटका के विशेष शब्द क्या है? </span> </label>
            <div class="g5v2a">
                <p> <b>सिंगल: </b>सट्टे के लिए 0 से 9 तक का एक अकेला अंक। उदाहरण के लिए 1।
                    <b>जोड़ी/पेयर: </b>मटका के लिए 00 से 99 तक किसी भी दो अंकों का सेट, जैसे 63 या 84 इत्यादि।
                    <b>पट्टी/पन्ना: </b>एक तीन-अंकीय परिणाम जुआ परिणाम के रूप में आता है। सभी तीन-अंकीय राशि पट्टी/पन्ना होती है। केवल सीमित 3 अंकीय संख्याएँ प्रयोग की जाती हैं।
                </p>
            </div>
        </div>
    </div>
    <div class="lst-sec">
        <h6>MATKA</h6>
        <p>Madhur Matka | Satta Bazar | Satta Kurla | Satta Com | Satta Batta | Org Mobi Net In | Satta Master | Matka Game | Kapil Indian Matka | Matka Parivar 24 | Prabhat Matka | Tara Matka | Golden Matka | SattaMatka.Com | Madhur Matka satta result chart, satta khabar, matka India net, satakmatak, satta chart 2019, satta bazar result, satta live, satta bazar, satta matka Mumbai chart, satta live result, satta fast result, satta fast, satta today Number 10, Satta Matka</p>
    </div>
    <div class="dis12">
        <h6>-:DISCLAIMER:-</h6>
        <p>Visiting this site and browsing it is strictly recommended at your own risk. Every information available here is only according to informational purpose and based on astrology and number calculations. We are no associated or affiliated with any illegal Matka business. We make sure we follow all rules and regulations of the regions where you are accessing the website. There are also chances that the website may be banned in your area and after that if you are using it, you are solely dependable and responsible for any damage, loss or legal action taken.
            <br>
            If you are the one who does not like our disclaimer it is advised that you leave our website immediately. Copying of any information/contents posted on the website is strictly prohibited and against the law.
        </p>
    </div>
    <!-- powered by us -->
    <h6 class="pow-13">POWERD BY DPBOSS</h6>
    <div class="lst-sec">
        <p>
            © 2011 - <?php echo date('Y'); ?> DPBOSS.CASH <br>
            <a href="#">Contact us</a> <br>
            <a href="#">Privacy &amp; policy</a> | <a href="#">Term And Conditions</a>
        </p>
    </div>
    <!-- refresh button -->
   
    <button onclick="saveScrollPosition(); window.location.reload();" class="clk1-rld btm-clk1-f">REFRESH </button>
    <script>
        function saveScrollPosition() {
            localStorage.setItem('scrollPosition', window.scrollY);
        }
        window.addEventListener('load', function() {
            var scrollPosition = localStorage.getItem('scrollPosition');
            if (scrollPosition !== null) {
                window.scrollTo(0, parseInt(scrollPosition));
                localStorage.removeItem('scrollPosition'); // Optional: Remove the item after using it
            }
        });
    </script>


</div>
