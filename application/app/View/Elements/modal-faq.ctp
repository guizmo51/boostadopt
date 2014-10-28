<div ng-controller="ModalFAQInstanceCtrl" >

    <script type="text/ng-template" id="ModalFAQ.html">
        <div class="modal-header">
            <h3>FAQ</h3>
        </div>
        <div class="modal-body">
			
			<div ng-controller="AccordionCtrl">
			    <accordion-group heading="Pourquoi cette application ?">
      Un ami a fait appel à moi pour mes compétences en informatique et cela lui a permis de recevoir de nombreuses visites après chaque booster. J'ai donc décidé de rendre cette application accessible à plus de personnes.
    </accordion-group>
       <accordion-group heading="Pourquoi faire payer ce booster ?">
      Afin de garantir une qualité de service optimale j'ai décidé de rendre ce service payant.Cela permet de limiter le nombre d'utilisateurs. Toutefois suivez BoostAdopt sur Facebook &amp; Twitter des tirages au sort permettront de remporter des booster gratuits.
    </accordion-group>
     <accordion-group heading="Est-ce autorisé ?">
     L'utilisation de l'extension fait que le booster que vous lancez  utilise votre propre adresse IP. Techniquement cela ne passe pas par les serveurs de boostAdopt.com.
    </accordion-group>
    <accordion-group heading="Quelles technologies sont utilisées ?">
      Ce projet utilise différentes technologies modernes comme PHP 5, Javascript, AngularJS etc :)
    </accordion-group>
			</div>
	</div>


        <div class="modal-footer">
           
            <button class="btn btn-warning" ng-click="close()">Close</button>
        </div>
    </script>

   
</div>
