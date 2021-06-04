{{--  --}}@if(isset(Auth::user()->id))




	@if($checker > 95)
		<div class="white-text w3-margin w3-center w3-border" style="background-color:   #1B5E20 !important;">
			<p class="w3-margin w3-center w3-xlarge c-t">Work Completed, @if($checker > 100) 100% @else {{ $checker }}% @endif<br><i class="mdi-action-thumb-up" style="font-size: 30px;"></i> Congratulation</p>
		</div>


		@elseif($checker > 85)
			<div class="white-text w3-margin w3-center w3-border" style="background-color:   #00E676 !important;">
				<p class="w3-margin w3-center w3-xlarge c-t"> Perfect work Done, (<b class = "black-text w3-medium" style="text-transform: lowercase;">left with: </b> {{100 - $checker }}%)</p>
			</div>


		@elseif($checker > 70)
			<div class="white-text w3-margin w3-center w3-border" style="background-color:   #69F0AE !important;">
				<p class="w3-margin w3-center w3-xlarge c-t">Good Job, (<b class = "black-text w3-medium" style="text-transform: lowercase;">left with: </b> {{100 - $checker }}%)</p>
			</div>

		@elseif($checker > 60)
			<div class="white-text w3-margin w3-center w3-border" style="background-color:  #00ccff !important;">
				<p class="w3-margin w3-center w3-xlarge c-t">Fair workdone, (<b class = "black-text w3-medium" style="text-transform: lowercase;">left with: </b> {{100 - $checker }}%)</p>
			</div>

		@elseif($checker > 50)
			<div class="white-text w3-margin w3-center w3-border orange">
				<p class="w3-margin w3-center w3-xlarge c-t">Average work done, (<b class = "black-text w3-medium" style="text-transform: lowercase;">left with: </b> {{100 - $checker }}%)</p>
			</div>

		@elseif($checker > 40)
			<div class="white-text w3-margin w3-center w3-border" style="background-color: #bf360c !important;">
				<p class="w3-margin w3-center w3-xlarge c-t">You are almost toward average, (<b class = "black-text w3-medium" style="text-transform: lowercase;">left with: </b> {{100 - $checker }}%)</p>
			</div>

	@else
	
		<div class="white-text w3-margin w3-center w3-border red">
			<p class="w3-margin w3-center w3-xlarge c-t">Much work  still need to be done, (<b class = "black-text w3-medium" style="text-transform: lowercase;">Left With: </b> {{100 - $checker }}%)</p>
		</div>

	@endif


@else

	<script>window.locaction = '/admin';</script>

@endif