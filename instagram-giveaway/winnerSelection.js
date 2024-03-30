// winnerSelection.js
document.addEventListener('DOMContentLoaded', () => {
    const comments = [
        "gabriel.brandao75", "joel_pedrosa_05", "andre_ferreira_13", "alexandrecioga", "yurizucca_", "cesar42reis_", 
        "brunopereira2222", "brave_indomavel2.0", "allspeeddrive", "tiagovski555", "joaooomeireles", "brunosavateoficial", 
        "nininhovazmaia_", "renat2ll", "mlmendonca8", "armandoo517", "nelson_oliveiraa", "falcao.80", "armandoo517", 
        "joaoss_19", "alex.caldeira30", "moutinho36", "mariadrummondd", "jucamesquita", "ritabelinha", "kikosousa_11", 
        "sandra.dias10", "rafasilva_98", "sebaa_rojas_", "nmorelli_", "jaimao_matos", "emily_estanqueiro", "_lucy.estanqueiro_", 
        "ketchupa_", "therisktaker_3", "rfazombies", "pedro2silva1", "jony_costaa", "rodrigogomes_007", "claudia.goncalves21", 
        "_.rodrineiva._", "aguabmartins", "edupereira98", "catarinamaia_5", "inesvrochaa", "isacframos", "nunogoncalo", "bduraes", 
        "tiago_gerardo", "tmarqee", "nunogoncalo", "adriano_____costa", "vitorhomartins", "brunobbbernardo", "nunobap_", "guii.moreiraa", 
        "joaocaianoo", "martimb23", "jaimao_matos", "_priv._.malacarne_", "david_epm21", "kaka_sht", "edgar___14", "rui_meireles_2005", 
        "ruicunha005", "leandro_couto002", "pauloribeiro.13", "tiagosampaio09", "fabio.araujo.378", "ricardo_junior_18", "rfazombies", 
        "therisktaker_3", "she8s_tcouto", "rafaellaia1308", "carlosvalle11", "vascomeska", "pedroparente_10", "gabriel_presa25", 
        "pauloribeiro.13", "_claudia25martins_", "margarida__ferreira_", "marinaaestanislau", "david_abgash99", "kikox._.skt", 
        "guilhxrme_7", "gbomar7", "rubensilvaa7", "tiagovski555", "imchentric", "brunomotahd", "pilarzinha_8", "junior.andrade03", 
        "kika._.pintooo", "beatriizvalente_", "rubensilvaa7", "cristiano", "otaviomonteiroo", "alextelles13", "goncacosta2011", 
        "ferreiradinisalexandre", "_wxy.luh", "santifern3d", "pedropinto_16", "dj_espetakulo", "tiago_machado2", "joaooomeireles", 
        "pedropinto_16", "brunopereira2222", "luisxgoncalves_1", "monteiro77777", "monteiro77777", "beatriz.fsousaa", "brunopereira2222", 
        "carlosvalle11", "martim.guterres", "joaoosilva6", "franciscoomaia92", "diogo.j.r.alves", "helenaborges0904", "jazmtt", 
        "zeferino1436", "ana_oliveira3952", "jaimao_matos", "ines_margarida_sousa", "betovskiii79", "nenebargarida_", "jaimao_matos", 
        "jaimematos11", "betoferreira79", "antonio23bernardo", "jaimao_matos", "anantunessss", "aneulibeira", "____anaoliveira", 
        "_andre_cachapa", "joao.miguel.16._", "rodrigogoncalves.28", "ana.bolas", "jaimao_matos", "carlitosposfriends", "abeillemaia", 
        "carlos_lopes04", "jaimao_matos", "drawmatic_246", "peanut._.butter._.123", "madalena246", "jaimao_matos", "agjc1234", 
        "kiko_tomaz", "setrg_tips", "_andre_cachapa", "ines.baleizao", "pedro_ventaneiras", "emanuelpucarinhas", "jaimao_matos", 
        "o.teu.pai", "o_caga_do_ninho", "omaigode_strawberryvodka", "_.junior.moreira._", "angelicapeixoto01", "noemi_ribeiro_moreira", 
        "pedromigueldacostamachado", "jaimao_matos", "carmo.s.alves", "anaapdsilva", "sec.patricinha", "jaimao_matos", "giovannamandier", 
        "gigiamandier", "lisales_20", "jaimao_matos", "lidia_salessss", "beto_da_bene", "joao_santos282", "jaimao_matos", "mercuryvein", 
        "siriusom.fg", "teresa.cireradoria", "den1s.8", "lucasmaia.17", "__.bernas.__", "dinis.pinto.006", "jaimao_matos", "sirvictahh", 
        "tiago30944", "sara_pereira06", "jaimao_matos", "_o_wega_", "gaby.alves_24", "_igor_abegao_", "nunobap_", "bernardotavares_padel", 
        "henriqueorge_08", "miguel_ramoa", "jaimao_matos", "afonso_serrano_", "afonso_graca19", "fontethecreator", "_diogo_.araujo", 
        "_daniel._aguiar_", "a.morim_", "wg._.vidal", "fernandoguimraes_689", "lhugocosta", "alexgommes05", "joaopaulobrinco", "nunobap_", 
        "vascobarbosaaaa", "dpereira0406", "bernardooliveira__", "diogomarques967", "m.g.2012.twins", "guifreitas2602", "jhonyy23es", 
        "nunobap_", "miguealfer", "pamealfer", "alechambino", "jaimao_matos", "franciscomfonte", "djodjohny", "joao.almeida.2306", 
        "nunobap_", "duarte_roxo", "tomas_turbando.5", "ricardocoelho2000", "damas_31", "luishenrique_lp", "miguel.af9", "tomasilva70", 
        "fernandoguimraes_689", "rodrigohneves10", "diabrantes14", "brincoantonio", "nunobap_", "proenca_19", "joao06guedes", "freddcosta_", 
        "emanuel_leonel", "nuno_x_freitas", "tiago_antunes19", "deivid_v_6", "fernandoguimraes_689", "_joaogomes_10", "salvador_sucena", 
        "rodrigo04.12.2008", "emanuel_leonel", "m1guel_pereira", "fred.miguel", "_.alvaroleonel._", "emanuel_leonel", "dq.hornet", 
        "klaus_canecorso", "ti_rider_pt", "fernandoguimraes_689", "afonso_faria47", "juh_fonseca_6954", "ines_hcerqueira", 
        "fernandoguimraes_689", "ofc_pinho", "brunapatronilho", "v_itoria_ribeiro", "jaimao_matos", "_odessa.fam_", "_miguelmartinho_21", 
        "lucas_gbrie", "_mariajoao_09", "priv._.mariajoao", "marcia.silva_ferreiro", "tiagovski555", "fernandoguimraes_689", "bbrunash", 
        "bea__antunes", "_.mariana._pinto", "nunobap_", "ppabalbo", "tommi2355", "_kiko.leite_", "falcao.80", "andre_ventura_oficial", 
        "brandilove__04", "cristiano", "nunobap_", "tomas.smoura", "tomasespanhol", "tomassabino1904", "nunobap_", "joaocaianoo", 
        "nunes.gustavo", "arturresende14", "micael.a_s", "daviid_s15", "carolina_melro", "alex.colopant", "miguel.vigario95", "_vigario23_", 
        "_.stitch.vigario23._", "arturvigario", "_vianinha__", "joana_a_c_silva", "roberto_azevedo_22", "pedrosousaass", "david.querido50", 
        "pv.furtzz", "querido.02", "diogo.r_17", "danny_monteiro_16", "yoodiego_21", "mota.qy", "pear.qy", "franciscomontenegro_10", 
        "constanca_montenegro", "camisolas_de_jogo_liga_bwin_", "camisolas_de_jogo_liga_bwin_", "franciscomontenegro_10", "henrique_guerra09", 
        "afonso._.carneiro", "joao_gfonseca_2011", "misterj0a0_duarte", "_rodrigog2474", "joaoxavierm_", "martim_04", "kikalaqueen_98", 
        "leo_brites99", "santiag0silva_", "_alice.gm_", "23luigi", "carolina__alcantara", "julia_miranda5", "analuisarodriguez78", 
        "guilhermeteixeira_25", "salsinha2006", "dinis_barboza", "dinis_barboza", "guilhermeteixeira_25", "mfddias0", "afonsosilva__20", 
        "dinismagueja19", "joaomorenopt", "anabertoloo", "mr.chuk", "beatrizbertolo", "jaimao_matos", "sofs_friendzz", "leonor._.piress", 
        "soy_liunor", "jaimao_matos", "mati_costa08", "_.matxiudji._", "roma.nogustavo", "jaimao_matos", "gustavo_ramalho05", "d0kkass", 
        "gbalente99", "jaimao_matos", "tomas_d_ribeiro", "privexx__mulato__", "_edi_tavares_", "jaimao_matos", "simoes_club", "yakuza_gs", 
        "guicsimoes_", "jaimao_matos", "tomascsimoes", "gato._.leitao", "franciscomfonte", "jaimao_matos", "henriquelopess55", "rickyspremium", 
        "decastrito.97", "jaimao_matos", "afonso_mrmd", "goncalo_viana2005", "miguxos_da_xerica", "jaimao_matos", "francisca.taveira", "zezins_", 
        "e.m.a.r.t_", "jaimao_matos", "antoniocosta_8", "putoo_to", "otadasconchas", "carlosvalle11", "tomasmsalazar", "davidmota17", 
        "davidmotasalazar", "carlosvalle11", "digas7", "diogomuge", "jucaaa.24", "carlosvalle11", "_candeias__", "del_erb", "mi_andrade99"];
    const winnerDisplay = document.getElementById('winnerDisplay');
    const startButton = document.getElementById('startButton');
    let currentIndex = 0;
    let interval;

    startButton.addEventListener('click', () => {
        startButton.disabled = true; // Disable the button to prevent multiple clicks
        interval = setInterval(() => {
            winnerDisplay.textContent = comments[currentIndex];
            currentIndex = (currentIndex + 1) % comments.length;
        }, 50); // Adjust speed as needed

        setTimeout(() => {
            clearInterval(interval); // Stop the "random" selection
            winnerDisplay.textContent = "jaimealmeidaaa"; // Set the predetermined winner
            startButton.disabled = false; // Enable the button again
        }, 5000); // Adjust duration as needed
    });
});
