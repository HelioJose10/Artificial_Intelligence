#Para a IA jogar contra o dealer tem que saber as carta na mesa 

#IA sabe o seu total e o total do dealer
#depois, se escolher HIT, calcula quais sao as cartas que se sairem lhe dao um resultada bom
# ou seja, total=21 ou total dealer<totalAI<21.
# existe entao um numero de cartas que se sairem trazem o total da IA acima dos 21 logo perde o jogo.
# 
#No caso de escolher STAND, o dealer irá jogar 
#existe um numero de cartas que se sairem ao dealer lhe sao favoraveis,
#ou seja, existem cartas, que consoante a mao do dealer, ao sairem fica total dealer>total IA, perde a IA
#e outras cartas que se sairem trazem o total IA>total dealer<21, logo o dealer escolher HIT.
#Assim termina um NODE da pesquisa
#O 2º NODE da pesquisa começa ou a IA escolhendo STAY e o dealer escolhendo HIT, ou a IA escolhendo HIT 
#e avançando depois para HIT outra vez (caso total<21) ou STAND e avançando para o dealer.

#concluindo, a IA calcula e compara as probabilidades de sairem cartas favoraveis à sua mao escolhendo ou HIT 
#ou STAND


from code import total

def removerCartas(handIA, handDealer):
    #copia as hands da IA e dealer
    iaTemp = handIA
    dealerTemp= handDealer

    #remove as cartas na mesa do deck 
    deck = [2, 3, 4, 5, 6, 7, 8, 9, 10, 2, 3, 4, 5, 6, 7, 8, 9, 10, 2, 3, 4, 5, 6, 7, 8, 9, 10, 2, 3, 4, 5, 6, 7, 8, 9, 10,
        'J', 'Q', 'K', 'A', 'J', 'Q', 'K', 'A', 'J', 'Q', 'K', 'A', 'J', 'Q', 'K', 'A']
    for card in iaTemp:
        if card in deck:
            deck.remove(card)
    for card in dealerTemp:
        if card in deck:
            deck.remove(card)
    return deck

def checkDealer2(handDealer):
    if len(dealerHand) == 2:
        return total(handDealer[0])
    elif len(dealerHand) > 2:
        return total(dealerHand)
    
def tomarDecisao(handIA, handDealer):
    
    deckDesfavoravel = []
    deckTemp2 = removerCartas(handIA, handDealer)
    
    if total(handIA) < 21:
        #escolher HIT (node 1)
        #desfavoravel (bust IA)
        while card in deckTemp2:
            if card + total(handIA) > 21:
                deckDesfavoravel.append(card)
        prob1 = len(deckDesfavoravel)/len(deckTemp2)
        deckDesfavoravel = []
        #caso totalIA=21 (revelar dealer)
        while card in deckTemp2:
            if card + total(handIA) == 21 | checkDealer2(handDealer) == 21:
                deckDesfavoravel.append(card)
        prob2 = len(deckDesfavoravel)/len(deckTemp2)
        #probabilidade sair carta para caso favoravel em HIT node 1 (totalDealer<totalIA<21) ou (totalDealer>totalIA<21)
        probFavHit = 1 - (prob1 + prob2)

        #escolher STAY (node 1)
        #dealer plays
        deckDesfavoravel = []
        leng = len(deckTemp2)
        if total(handDealer) < total(handIA):
            while card in deckTemp2 | total(handDealer) < 21:
                if card + total(handDealer) > total(handIA):
                    deckDesfavoravel.append(card)
                    deckTemp2.remove(card)
            probs1 = len(deckDesfavoravel)/leng
            leng2 = len(deckTemp2)
            while card in deckTemp2 | total(handDealer) < 21:
                if card + total(handDealer) == total(handIA):
                    deckDesfavoravel.append(card)
                    deckTemp2.remove(card)
            probs2 = len(deckDesfavoravel)/leng2
            #probabilidade sair carta para caso favoravel em STAND node 1 
            probFavStand = 1 -(probs1 + probs2)
        
        #tomar a decisão de dar HIT
        if probFavHit > probFavStand:
            #IA joga HIT
            return True
        else:
            #IA joga STAND
            return False

        



    
    





