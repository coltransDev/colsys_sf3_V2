<?
/**
 * Software descargado del sitio www.hotsripts.com
 *
 * License Type: GPL 
 * 
 * @version $Id$
 * @copyright 2004
 **/

Class SMTP {

Var     $errno     = 0;
Var     $errmsg    = '';
Var     $errors    = Array(
        1 => 'Invalid Input',
        2 => 'Unable to establish connection',
        3 => 'Connection timed out',
        4 => 'SMTP Error returned',
        );

Var     $server         = "";
Var     $user           = "";
Var     $sock           = false;
Var     $readlength     = 1024;

Var     $mailto         = array();
Var     $mailcc         = array();
Var     $mailfrom       = "";
Var     $mailfromtitle  = '';
Var     $mailsubject    = "";
Var     $mailtext       = "";
Var     $attachments    = array();

Var     $deadmsg        = "";
Var     $verbose        = "0";

Function SMTP($server, $timeout=10)
        {
        if (strlen($server)<=0)
                return $this->error(1, 'server');
        else    $this->server=$server;

        if (!$this->sock = fsockopen($server, 25, &$errno, &$errstr, $timeout))
                return $this->error(2, 'Unable to establish connection');

        if (!socket_set_blocking($this->sock, true))
                return $this->error(4, 'set blocking');

        if (!$this->GetFeedback())
                return $this->error(2, 'during onset');

        return true;
        }

Function Error($errno, $message)
        {
        $this->errno=$errno;
        $this->errmsg.=$message;
        return false;
        }

Function ErrMsg($error=false)
        {
        if (false===$error)
           return $this->errmsg;
        else
           return $this->$errors[$error];
        }

Function ErrNo()
        {
        return $this->errno;
        }

Function SetSubject($subject)
        {
        if (strlen($subject)<=0)
                return $this->Error(1, 'subject');
        $this->mailsubject = ereg_replace("\n"," ",$subject);
        return true;
        }

Function setText($text)
        {
        if (strlen($text)<=0)
                return $this->Error(1, 'message body');
        $text = ereg_replace("\n.\n", "\n. \n", $text);
        $text = ereg_replace("\n.\r", "\n. \r", $text);
        $this->mailtext = $text;
        return true;
        }

Function SetTo($to)
        {
        if (strlen($to)<=0)
                return $this->Error(1, '"to" too short');
        if (strlen($to)>=129)
                return $this->Error(1, '"to" too long');
        $this->mailto[]=$to;
        return true;
        }

Function SetToTitle($title)
        {
        if (strlen($title)<=0)
                return $this->Error(1, 'totitle too short');
        if (strlen($title)>=128)
                return $this->Error(1, 'totitle too long');
        $this->mailtotitle="<$title>";
        return true;
        }

function SetCC($to)
        {
        if (!$this->setto($to))
                return false;
        $this->mailcc[]=$to;
        return true;
        }

Function SetFrom($from)
        {
        if (strlen($from)<=0)
                return $this->Error(1, 'from too short');
        if (strlen($from)>=128)
                return $this->Error(1, 'from too long');
        $this->mailfrom=$from;
        return true;
        }

Function SetFromTitle($title)
        {
        if (strlen($title)<=0)
                return $this->Error(1, 'fromtitle too short');
        if (strlen($title)>=128)
                return $this->Error(1, 'fromtitle too long');
        $this->mailfromtitle=$title;
        return true;
        }

function AddAttachment($type, $data, $name)
        {
        $insert=sizeof($this->attachements);
        $this->attachements[$insert][data]=$data;
        $this->attachements[$insert][type]=$type;
        $this->attachements[$insert][name]=$name;
        return false;
        }

Function BuildBody($MIMEType)
        {
        if ($MIMEType=='text')
                $return = "Content-Type: text/plain; charset=iso-8859-1\r\n";
        elseif($MIMEType=='html')
                $return = "Content-Type: text/html; charset=iso-8859-1\r\n";
        else
                $return = "Content-Type: text/plain; charset=iso-8859-1\r\n";

        if (strlen($this->mailtotitle)>=1)
                $return.="To: ".$this->mailtotitle."\r\n";

        if (strlen($this->mailfromtitle)>=1)
                $return.="From: ".$this->mailfromtitle." <".$this->mailfrom.">\r\n";
        else    $return.="From: ".$this->mailfrom."\r\n";

        if (sizeof($this->mailcc)>=1)
                {
                $return.="Cc:";
                for ($i=0; $i<sizeof($this->mailcc); $i++)
                        {
                        if ($i)
                                $return.=", ";
                        $return.=$this->mailcc[$i];
                        }
                $return.="\r\n";
                }

        if (strlen($this->mailsubject)>=1)
                $return.="Subject: ".$this->mailsubject."\r\n";

        $return .="X-Priority: 1\r\n";
        $return .= "\r\n" . $this->mailtext;

        return $return;
        }

Function sendmail($text_type='html')
        {
        if (!$this->sock)
                return $this->error(2);
        else    {
                if (!$body=$this->BuildBody($text_type))
                        return $this->Error(1, 'BuildBody Failed');

                $head[]="HELO ".$this->server;
                $head[]="MAIL FROM:<".$this->mailfrom.">";
                while (list($key, $value)= each($this->mailto))
                        {
                        $head[]="RCPT TO:<$value>";
                        }
                $head[]='DATA';

                reset ($head);

                while (list($key, $value)=each ($head))
                        {
                        fputs($this->sock, $value."\r\n");
                        if (!$this->GetFeedback())
                                return $this->error($this->errno(), "($value)");
                        }

                fputs($this->sock, "$body\r\n.\r\n");
                if (!$this->GetFeedback())
                        return false;
                }
        $this->ResetData();
        return true;
        }

function ResetData()
        {
        $mailto         = array();
        $mailfrom       = "";
        $mailfromtitle  = '';
        $mailsubject    = "";
        $mailtext       = "";
        $attachments    = array();
        return true;
        }

Function GetFeedback()
        {
        if (!$response=fgets($this->sock, $this->readlength))
                return false;
        if ($this->IsOK($response))
                return true;
        else    return false;
        }

Function IsOK ($input)
        {
        if (!ereg("((^[0-9])([0-9]*))", $input, $regs))
                return $this->error(1, 'input');

        $code=$regs[1];

        switch ($code)
                {
                case '220':
                case '221':
                case '250':
                case '251':
                case '354':
                        return true;
                        break;
                default:
                        return $this->error(4, $input);
                        break;
                }
        }

Function end()
        {
        if (!$this->sock)
                return $this->error(3, 'function end');

        fputs($this->sock, "QUIT\r\n");

        if ($this->GetFeedback())
                {
                fclose($this->sock);
                return true;
                }
        else    {
                return false;
                }
        }
}
?>