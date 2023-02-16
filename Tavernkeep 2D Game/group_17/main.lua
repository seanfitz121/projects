-----------------------------------------------------------------------------------------
--
-- main.lua
--
-----------------------------------------------------------------------------------------
math.randomseed( os.time() )
local physics = require("physics")
physics.start()
physics.setGravity(0,0)
local reset = false

local backGroup = display.newGroup()
local mainGroup = display.newGroup()

local background = display.newImageRect("cobblewall.png", 768, 1024)
background.x = display.contentCenterX
background.y = display.contentCenterY

local bottomScreen = display.newImageRect("background2.jpg", 575, 675)
bottomScreen.x = display.contentCenterX
bottomScreen.y = display.contentHeight-270

local tableTop = display.newImageRect("table.jpg", 768, 125)
tableTop.x = display.contentCenterX
tableTop.y = display.contentHeight-600
--Image source: https://www.123rf.com/photo_119466657_stock-vector-wood-texture-brown-plank-wooden-background-in-cartoon-style-vector-illustration-.html



local label = display.newImageRect("label.png", 384, 70)
label.x = display.contentCenterX
label.y = display.contentHeight-1000
label.alpha = 0.80

name = display.newText("TavernKeep", display.contentCenterX, display.contentHeight-995, "customFont.ttf", 30)

local scraper = display.newImageRect("scraper.png", 20, 120)
scraper.x = display.contentWidth-510
scraper.y = display.contentHeight-432
scraper.alpha = 0


local options =
{
    width = 250,
    height = 620,
    numFrames = 6,
    sheetContentWidth = 1500,
    sheetContentHeight = 620
}

local tapSheet = graphics.newImageSheet("Tap3SHEET.png", options)

local sequences_taps = {
  {
    name = "tapFlow",
    start = 1,
    count = 6,
    time = 500,
    loopCount = 1,
    loopDirection = "forward"
  }
}
local flowingTap = display.newSprite(tapSheet, sequences_taps)
flowingTap.x = display.contentCenterX
flowingTap.y = display.contentHeight-340
flowingTap.xScale = 300/336
flowingTap.yScale = 0.80

local glassTable = display.newImageRect("glassTable.png", 310, 30)
glassTable.x = display.contentCenterX
glassTable.y = display.contentHeight-80

local options2 =
{
    width = 500,
    height = 500,
    numFrames = 6
}
local sequences_glass = {
  {
    name = "beerFill",
    start = 1,
    count = 6,
    time = 4000,
    loopCount = 1,
    loopDirection = "forward"
  }
}
local options4 =
{
    width = 147,
    height = 398,
    numFrames = 2
}
local sequences_bottle = {
  {
    name = "bottleOpen",
    start = 1,
    count = 2,
    time = 0,
    loopCount = 1,
    loopDirection = "forward"
  }
}
local glassSheet = graphics.newImageSheet("BeerSheet.png", options2)
local bottleSheet = graphics.newImageSheet("BottleSheet.png", options4)
    bottle = display.newSprite(bottleSheet, sequences_bottle)
    bottle.x = display.contentWidth-600
    bottle.y = display.contentHeight-192
    bottle.xScale = 1/2
    bottle.yScale = 1/2

local bottleOpener = display.newImageRect("bottleopener.png", 80, 80)
bottleOpener.x = display.contentWidth-160
bottleOpener.y = display.contentHeight-330

local function createGlass()
  beerGlass = display.newSprite(glassSheet, sequences_glass)
  physics.addBody(beerGlass, "kinematic", {radius = 75, bounce = 0})
  beerGlass.x = display.contentWidth-375
  beerGlass.y = display.contentHeight-195
  beerGlass.xScale = 2/5
  beerGlass.yScale = 2/5
end
createGlass()

local options3 =
{
    width = 200,
    height = 800,
    numFrames = 4
}

local sequences_temp = {
  {
    name = "tempSeq",
    start = 1,
    count = 4,
    time = 24000,
    loopCount = 1,
    loopDirection = "forward"
  }
}
local tempSheet = graphics.newImageSheet("TempSheet.png", options3)
temp1 = display.newSprite(tempSheet, sequences_temp)
temp1.alpha = 0
temp1.x = display.contentWidth-500
temp1.y = display.contentHeight-850
temp1.xScale = 1/7
temp1.yScale = 1/7

temp2 = display.newSprite(tempSheet, sequences_temp)
temp2.alpha = 0
temp2.x = display.contentWidth-300
temp2.y = display.contentHeight-850
temp2.xScale = 1/7
temp2.yScale = 1/7

temp3 = display.newSprite(tempSheet, sequences_temp)
temp3.alpha = 0
temp3.x = display.contentWidth-110
temp3.y = display.contentHeight-850
temp3.xScale = 1/7
temp3.yScale = 1/7

local score = 0
local died = false
local patronsTable = {}
local pos1filled = false
local pos2filled = false
local pos3filled = false
local pos1 = display.newImageRect("BLANK.png", 1, 1)
    pos1.x = display.contentWidth-576
local pos2 = display.newImageRect("BLANK.png", 1, 1)
    pos2.x = display.contentWidth-384
local pos3 = display.newImageRect("BLANK.png", 1, 1)
    pos3.x = display.contentWidth-192

local scoreText
scoreText = display.newText("Score: " .. score, 384, 80, "customFont.ttf", 30)
local function updateText()
    scoreText.text = "Score: " .. score
  end
  gameLoopTimer6 = timer.performWithDelay( 1, updateText, 0 )
display.setStatusBar(display.HiddenStatusBar)

local options3 =
{
    width = 550,
    height = 618,
    numFrames = 3
}
local patronSheet = graphics.newImageSheet("PatronObjectSheet.png", options3)
local newPatron1 = display.newImageRect(patronSheet, 1, 180, 180)
physics.addBody(newPatron1, "kinematic", {radius = 50, bounce = 0})
table.insert(patronsTable, newPatron1)
newPatron1.y = -1000
newPatron1.x = pos1.x
pos1filled = false

local newPatron2 = display.newImageRect(patronSheet, 2, 180, 180)
physics.addBody(newPatron2, "kinematic", {radius = 50, bounce = 0})
table.insert(patronsTable, newPatron2)
  newPatron2.x = pos2.x
  newPatron2.y = -1000
  pos2filled = false

  local newPatron3 = display.newImageRect(patronSheet, 3, 180, 180)
  physics.addBody(newPatron3, "kinematic", {radius = 50, bounce = 0})
  table.insert(patronsTable, newPatron3)
    newPatron3.x = pos3.x
    newPatron3.y = -1000
    pos3filled = false
    local desire
    local desire2
    local desire3
    local options5 =
        {
            width = 260,
            height = 194,
            numFrames = 2
        }
    local desireSheet = graphics.newImageSheet("DesireSheet.png", options5)

    local function createDesire()

          randomDesire1 = math.random()
          if randomDesire1 > 0.66 then
            desire = display.newImageRect(desireSheet, 1, 140, 120)
            desire.x = 190
            desire.y = 420
          else
            desire = display.newImageRect(desireSheet, 2, 140, 120)
            desire.x = 190
            desire.y = 420
          end
  end
        local function createDesire2()

        randomDesire2 = math.random()
        if randomDesire2 > 0.66 then
          desire2 = display.newImageRect(desireSheet, 1, 140, 120)
          desire2.x = display.contentCenterX
          desire2.y = 420
        else
          desire2 = display.newImageRect(desireSheet, 2, 140, 120)
          desire2.x = display.contentCenterX
          desire2.y = 420
      end
  end
  local function createDesire3()

  randomDesire3 = math.random()
  if randomDesire3 > 0.66 then
    desire3 = display.newImageRect(desireSheet, 1, 140, 120)
    desire3.x = display.contentWidth-190
    desire3.y = 420
  else
    desire3 = display.newImageRect(desireSheet, 2, 140, 120)
    desire3.x = display.contentWidth-190
    desire3.y = 420
end
end
local function createPatron()

  if pos1filled == false then
    newPatron1.y = 272
    newPatron1.x = pos1.x
    pos1filled = true
    temp1.alpha = 1
    temp1:setSequence("tempSeq")
    temp1:play()
    createDesire()
  elseif pos2filled == false then
    newPatron2.x = pos2.x
    newPatron2.y = 272
    pos2filled = true
    temp2.alpha = 1
    temp2:setSequence("tempSeq")
    temp2:play()
    createDesire2()
  elseif pos3filled == false then
    newPatron3.x = pos3.x
    newPatron3.y = 272
    pos3filled = true
    temp3.alpha = 1
    temp3:setSequence("tempSeq")
    temp3:play()
    createDesire3()
      end
    end
audio.setVolume(0.5)
local beerSound = audio.loadSound("beerPour.mp3")

local servedSound = audio.loadSound("servedSound.mp3")
local bottleOpenSound = audio.loadSound("bottleOpen1.mp3")
local i = 3500
local function gameLoop()
  createPatron()

  local over50 = false
  local over100 = false
  local over150 = false
  local over200 = false
  if score >= 50 and over50 == false then
    over50 = true
    i = 3000
    temp1.timeScale = 1.2
    temp2.timeScale = 1.2
    temp3.timeScale = 1.2
  end
  if score >= 100 and over100 == false then
    over100 = true
    i = 2200
    temp1.timeScale = 1.4
    temp2.timeScale = 1.4
    temp3.timeScale = 1.4
  end
  if score >= 150 and over150 == false then
    over150 = true
    i = 1500
    temp1.timeScale = 1.6
    temp2.timeScale = 1.6
    temp3.timeScale = 1.6
  end
  if score >= 200 and over200 == false then
    over200 = true
    i = 1000
    temp1.timeScale = 1.8
    temp2.timeScale = 1.8
    temp3.timeScale = 1.8
  end
  gameLoopTimer = timer.performWithDelay( i, gameLoop, 1 )
end
gameLoop()
local stopped = false
local pouring = false
local moved = false
local ended = false

flowingTap:addEventListener("tap", function() return true end)
  local x = false
local function useTap(event)
    local flowingTap = event.target
    local phase = event.phase


        if  ("began" == phase) then
              display.currentStage:setFocus(flowingTap)

          elseif ("moved" == phase  and x == false) then
              x = true
              flowingTap:play()
              pouring = true
              audio.play(beerSound)
          elseif ( "ended" == phase or "cancelled" == phase ) then
              flowingTap:setFrame(1)
              audio.pause(beerSound)
              pouring = false
              x = false
              display.currentStage:setFocus( nil )
        end


    return true
end
flowingTap:addEventListener("touch", useTap)
beerGlass:setSequence("beerFill")
local function gameLoop2()
  beerGlass:toFront()
  scraper:toFront()
  if beerGlass.frame == 6 then

  elseif moved == true then

            elseif pouring == true then
              if reset == true then
                beerGlass:setSequence("beerFill")
                reset = false
              end
              beerGlass:play()
            elseif pouring == false then
              beerGlass:pause()
            end


end
gameLoopTimer2 = timer.performWithDelay( 10, gameLoop2, 0 )

local function dragBeer(event)
    local beerGlass = event.target
    local phase = event.phase
    ended = false

    if beerGlass.frame == 5 then

    if "began" == phase then
      display.currentStage:setFocus(beerGlass)
      beerGlass.touchOffsetX = event.x - beerGlass.x
      beerGlass.touchOffsetY = event.y - beerGlass.y
    elseif "moved" == phase then
      moved = true
      beerGlass.x = event.x - beerGlass.touchOffsetX
      beerGlass.y = event.y - beerGlass.touchOffsetY
    elseif "ended" == phase or "cancelled" == phase then
      display.currentStage:setFocus(nil)
      ended = true

    end
  end
    return true
end

beerGlass:addEventListener("touch", dragBeer)
local ended2 = false
local function dragBottle(event)

    local bottle = event.target
    local phase = event.phase
    ended2 = false

    if "began" == phase then
      bottle:toFront()
      display.currentStage:setFocus(bottle)
      bottle.touchOffsetX = event.x - bottle.x
      bottle.touchOffsetY = event.y - bottle.y
    elseif "moved" == phase then

      bottle.x = event.x - bottle.touchOffsetX
      bottle.y = event.y - bottle.touchOffsetY
    elseif "ended" == phase or "cancelled" == phase then
      display.currentStage:setFocus(nil)
      ended2 = true
    end
    return true
end
bottle:addEventListener("touch", dragBottle)
bottle:setSequence("bottleOpen")
local played = false
local function bottleCollision()
  if (((bottle.x > display.contentWidth-200 and bottle.x < display.contentWidth-10) and (bottle.y > display.contentHeight-200) and (bottle.y < display.contentHeight-50) and played == false)) then
    bottle:play()
    played = true
    audio.play(bottleOpenSound)
 end
 if (((bottle.x > 0 and bottle.x < 250) and (bottle.y > 100) and (bottle.y < 350)) and (pos1filled == true) and (ended2 == true) and (randomDesire1 >= 0.66) and (played == true)) then

   bottle.x = display.contentWidth-600
   bottle.y = display.contentHeight-195
   bottle:setFrame(1)
  newPatron1.y = -1000
  pos1filled = false
  reset = true
  bottle:setFrame(1)
  played = false
  ended2 = false
  score = score + 10
  temp1.alpha = 0
  temp1:pause()
  temp1:setFrame(1)
  audio.play(servedSound)
  desire:removeSelf()
end
if (((bottle.x > 251 and bottle.x < 450) and (bottle.y > 100) and (bottle.y < 350)) and (pos2filled == true) and (ended2 == true) and (randomDesire2 >= 0.66) and (played == true)) then

  bottle.x = display.contentWidth-600
  bottle.y = display.contentHeight-195
  bottle:setFrame(1)
 newPatron2.y = -1000
 pos2filled = false
 reset = true
 bottle:setFrame(1)
 played = false
 ended2 = false
 score = score + 10
 temp2.alpha = 0
 temp2:pause()
 temp2:setFrame(1)
 audio.play(servedSound)
 desire2:removeSelf()
end
if (((bottle.x > 451 and bottle.x < 650) and (bottle.y > 100) and (bottle.y < 350)) and (pos3filled == true) and (ended2 == true) and (randomDesire3 >= 0.66) and (played == true)) then

  bottle.x = display.contentWidth-600
  bottle.y = display.contentHeight-195
  bottle:setFrame(1)
newPatron3.y = -1000
pos3filled = false
reset = true
bottle:setFrame(1)
played = false
ended2 = false
score = score + 10
temp3.alpha = 0
temp3:pause()
temp3:setFrame(1)
audio.play(servedSound)
desire3:removeSelf()
end

end
gameLoopTimer100 = timer.performWithDelay( 1, bottleCollision, 0 )
local function beerCollision()

   if (((beerGlass.x > 0 and beerGlass.x < 250) and (beerGlass.y > 100) and (beerGlass.y < 350)) and (ended == true) and (pos1filled == true) and (randomDesire1 < 0.66)) then

    beerGlass.x = display.contentWidth-375
    beerGlass.y = display.contentHeight-195
    newPatron1.y = -1000
    pos1filled = false
    reset = true
    beerGlass:setFrame(1)
    moved = false
    ended = false
    score = score + 10
    temp1.alpha = 0
    temp1:pause()
    temp1:setFrame(1)
    audio.play(servedSound)
    desire:removeSelf()
  end
  if (((beerGlass.x > 251 and beerGlass.x < 450) and (beerGlass.y > 100) and (beerGlass.y < 350)) and (ended == true) and (pos2filled == true) and randomDesire2 < 0.66) then

   beerGlass.x = display.contentWidth-375
   beerGlass.y = display.contentHeight-195
   newPatron2.y = -1000
   pos2filled = false
   reset = true
   beerGlass:setFrame(1)
   moved = false
   ended = false
   score = score + 10
   temp2.alpha = 0
   temp2:pause()
   temp2:setFrame(1)
   audio.play(servedSound)
   desire2:removeSelf()
 end
 if (((beerGlass.x > 451 and beerGlass.x < 650) and (beerGlass.y > 100) and (beerGlass.y < 350)) and (ended == true) and (pos3filled == true) and randomDesire3 < 0.66) then

  beerGlass.x = display.contentWidth-375
  beerGlass.y = display.contentHeight-195
  newPatron3.y = -1000
  pos3filled = false
  reset = true
  beerGlass:setFrame(1)
  moved = false
  ended = false
  score = score + 10
  temp3.alpha = 0
  temp3:pause()
  temp3:setFrame(1)
  audio.play(servedSound)
  desire3:removeSelf()
end

end
gameLoopTimer3 = timer.performWithDelay( 1, beerCollision, 0 )

local gameOverVal = false
local function gameLoop7()
  if temp1.frame == 4 then
    display.remove(newPatron2)
    display.remove(newPatron3)
    display.remove(temp2)
    display.remove(temp3)
    desire2:removeSelf()
    desire3:removeSelf()
    gameOver = display.newText("Game Over!", display.contentCenterX, display.contentCenterY, "customFont.ttf", 70)
    gameOver1 = display.newText("You got " .. score, display.contentCenterX, display.contentCenterY+70, "customFont.ttf", 60)
    beerGlass.x = -1000
    gameOverVal = true
      timer.cancel(gameLoopTimer)
       timer.cancel(gameLoopTimer2)
        timer.cancel(gameLoopTimer3)
         timer.cancel(gameLoopTimer6)
          timer.cancel(gameLoopTimer7)
           timer.cancel(gameLoopTimer8)
            timer.cancel(gameLoopTimer9)
             timer.cancel(gameLoopTimer100)
  end
  if temp2.frame == 4 then
    display.remove(newPatron1)
    display.remove(newPatron3)
    display.remove(temp1)
    display.remove(temp3)
    desire:removeSelf()
    desire3:removeSelf()
    gameOver = display.newText("Game Over!", display.contentCenterX, display.contentCenterY, "customFont.ttf", 70)
    gameOver1 = display.newText("You got " .. score, display.contentCenterX, display.contentCenterY+70, "customFont.ttf", 60)
    beerGlass.x = -1000
    gameOverVal = true
    timer.cancel(gameLoopTimer)
     timer.cancel(gameLoopTimer2)
      timer.cancel(gameLoopTimer3)
       timer.cancel(gameLoopTimer6)
        timer.cancel(gameLoopTimer7)
         timer.cancel(gameLoopTimer8)
          timer.cancel(gameLoopTimer9)
           timer.cancel(gameLoopTimer100)
  end
  if temp3.frame == 4 then
    display.remove(newPatron1)
    display.remove(newPatron2)
    display.remove(temp1)
    display.remove(temp2)
    desire:removeSelf()
    desire2:removeSelf()
    gameOver = display.newText("Game Over!", display.contentCenterX, display.contentCenterY, "customFont.ttf", 70)
    gameOver1 = display.newText("You got " .. score, display.contentCenterX, display.contentCenterY+70, "customFont.ttf", 60)
    beerGlass.x = -1000
    gameOverVal = true
    timer.cancel(gameLoopTimer)
     timer.cancel(gameLoopTimer2)
      timer.cancel(gameLoopTimer3)
       timer.cancel(gameLoopTimer6)
        timer.cancel(gameLoopTimer7)
         timer.cancel(gameLoopTimer8)
          timer.cancel(gameLoopTimer9)
           timer.cancel(gameLoopTimer100)
  end

end
gameLoopTimer7 = timer.performWithDelay( 1, gameLoop7, 0 )
scraperText = display.newText("Use scraper", display.contentWidth-505, display.contentHeight-330, "customFont.ttf", 30)
scraperText.alpha = 0
local function gameLoop8 ()


      if ((scraper.x > 310 and scraper.x < 450) and (scraper.y > 720) and (scraper.y < 850)) then
          beerGlass:setSequence("beerFill")
          beerGlass:setFrame(5)

          scraperText.alpha = 0
          scraper.x = display.contentWidth-510
          scraper.y = display.contentHeight-432
          scraper.alpha = 0
        end
end
gameLoopTimer8 = timer.performWithDelay(10, gameLoop8, 0)
local function dragScraper (event)
    local scraper = event.target
    local phase = event.phase

    if "began" == phase then
      display.currentStage:setFocus(scraper)
      scraper.touchOffsetX = event.x - scraper.x
      scraper.touchOffsetY = event.y - scraper.y

    elseif "moved" == phase then
      scraper.x = event.x - scraper.touchOffsetX
      scraper.y = event.y - scraper.touchOffsetY

    elseif "ended" == phase or "cancelled" == phase then
      display.currentStage:setFocus(nil)
    end
    return true
end
scraper:addEventListener("touch", dragScraper)

local function gameLoop9 ()
    if beerGlass.frame == 6 then
      scraper.alpha = 1
      scraperText.alpha = 1
    end
end
gameLoopTimer9 = timer.performWithDelay(10, gameLoop9, 0)

--add 2nd drink
