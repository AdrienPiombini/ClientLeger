	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
	<link rel="stylesheet" href="css/toConnect.css">
   	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Connexion</span><span>Inscription</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
                                            <form method="post" class="form">
											<h4 class="mb-4 pb-3">Connexion</h4>
											<div class="form-group">
												<input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off" required>
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" name="mdp" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off" required>
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<br>
										    <input type="submit" value='Connexion' name='signin'>
                            				<p class="mb-0 mt-4 text-center"><a href="index.php?page=4" class="link">Forgot your password?</a></p>
                                            </form>
				      					</div>
			      					</div>
			      				</div>
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
                                        <form method="post" class="form">
											<h4 class="mb-4 pb-3">Formulaire d'inscription</h4>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="particulier" required>
												<label class="form-check-label" for="flexRadioDefault1">Particulier</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="professionnel" required>
												<label class="form-check-label" for="flexRadioDefault2">Professionnel</label>
											</div>
											<br>
											<div class="form-group">
												<input type="email" name="email" class="form-style" placeholder="Email" id="logname" autocomplete="off" >
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="text" name="nom" class="form-style" placeholder="Nom" id="logname" autocomplete="off" >
												<i class="input-icon uil uil-user"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="text" name="adresse" class="form-style" placeholder="Adresse" id="logname" autocomplete="off">
												<i class="input-icon uil uil-house-user"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="text" name="ville" class="form-style" placeholder="Ville" id="logname" autocomplete="off">
												<i class="input-icon uil uil-home"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="text" name="codepostal" class="form-style" placeholder="Code postal" id="logpass" autocomplete="off">
												<i class="input-icon uil uil-mailbox"></i>
											</div>
											<div class="form-group mt-2">
												<input type="text" name="telephone" class="form-style" placeholder="Téléphone" id="logname" autocomplete="off">
												<i class="input-icon uil uil-phone"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" name="mdp" class="form-style" placeholder="Mot de passe fort" id="logpass" autocomplete="off" required>
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<br>
											<div class="form-group mt-2">
												<select name="question" class="form-style"  id="logname" autocomplete="off">
													<option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?</option>
													<option value="Quel était le nom de votre premier animal de compagnie ?">Quel était le nom de votre premier animal de compagnie ?</option>
													<option value="Comment s'appelait votre instituteur préféré à l'ecole primaire ?">Comment s'appelait votre instituteur préféré à l'ecole primaire ?</option>
												</select>
												<i class="input-icon uil uil-question-circle"></i>
											</div>
											<div class="form-group mt-2">
												<input type="text" name="reponse" class="form-style" placeholder="Reponse secrete" id="logname" autocomplete="off">
												<i class="input-icon uil uil-comment-lock"></i>
											</div>	
											<br>
											<input type="submit" name="inscription" value="Inscription" >
                                        </form>
				      					</div>
			      					</div>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>